#!/usr/bin/php
<?php
$loader = require __DIR__ . "/../vendor/autoload.php";

\cli\Colors::enable();
use InstantWin\Player;
use InstantWin\Distribution\EvenOverTimeDistribution;
use InstantWin\TimePeriod;

$screenCols = exec('tput cols');

for ($tries = 0; $tries < 20; $tries++) {

    $durationInSeconds = 20000;

    $eachDot = ceil($durationInSeconds / ($screenCols-3));

    /*
    use InstantWin\Distribution\FixedOddsDistribution;
    $dist = new FixedOddsDistribution();
    $dist->setOdds(0.002);

    $player = new Player();
    $player->setDistribution($dist);
    $player->setMaxWins(3);
    */

    $dist = new EvenOverTimeDistribution();

    $timePeriod = new TimePeriod();
    $timePeriod->setStartTimestamp(1);
    $timePeriod->setEndTimestamp($durationInSeconds);

    $player = new Player();
    $player->setDistribution($dist);
    $player->setCurWins(0);
    $player->setMaxWins(3);
    $player->setTimePeriod($timePeriod);


    $wins  = 0;
    $plays = 0;
    for($curTime = 0; $curTime <= $durationInSeconds; $curTime++) {

        $timePeriod->setCurrentTimestamp($curTime);
        $player->setPlayCount($curTime);

        $win = $player->isWinner();

        if ($win) {
            $wins++;
            $player->setCurWins($wins);
            printWin($wins);
        } else {
            if ($curTime % $eachDot == 0) {
                printLossDot();
            }
        }

    }

    echo "\n\n";

}

function printWin($winCount)
{
    cli\out('%k%' . $winCount . $winCount);
}

function printLossDot()
{
    cli\out('%n%0.');
}