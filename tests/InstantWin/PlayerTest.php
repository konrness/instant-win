<?php
/**
 * Created by PhpStorm.
 * User: kness
 * Date: 3/20/14
 * Time: 10:34 AM
 */

namespace InstantWin;


use InstantWin\Distribution\FixedOddsDistribution;

class PlayerTest extends \PHPUnit_Framework_TestCase {

    public function testExpectedFixedOdds()
    {
        $dist = new FixedOddsDistribution();
        $dist->setOdds(0.5);

        $player = new Player();
        $player->setDistribution($dist);

        $wins  = 0;
        for($plays = 0; $plays < 1000; $plays++) {
            if ($player->isWinner()) {
                $wins++;
            }
        }

        $this->assertRoughlyEqual($plays * 0.5, $wins, $plays);
    }

    public function testExpectedLowFixedOdds()
    {
        $dist = new FixedOddsDistribution();
        $dist->setOdds(0.01);

        $player = new Player();
        $player->setDistribution($dist);

        $wins  = 0;
        for($plays = 0; $plays < 1000; $plays++) {
            if ($player->isWinner()) {
                $wins++;
            }
        }

        $this->assertRoughlyEqual($plays * 0.01, $wins, $plays);
    }

    /**
     * Factors in a margin of error, assuming 95% confidence
     *
     * @param $expected
     * @param $actual
     * @param $quantity
     */
    public function assertRoughlyEqual($expected, $actual, $quantity)
    {
        // @see http://en.wikipedia.org/wiki/Margin_of_error#Different_confidence_levels
        $marginOfError = (0.98 / sqrt($quantity)) * $quantity;

        $this->assertGreaterThanOrEqual($expected - $marginOfError, $actual);
        $this->assertLessThanOrEqual($expected + $marginOfError, $actual);
    }

}
 