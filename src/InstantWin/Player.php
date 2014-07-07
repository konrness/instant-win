<?php

namespace InstantWin;

use InstantWin\Distribution\AbstractDistribution;
use InstantWin\Distribution\TimePeriodAwareInterface;
use InstantWin\Distribution\WinAmountAwareInterface;
use InstantWin\TimePeriod;

/**
 * Allows for executing a play on an instant-win game
 *
 * @author Konr Ness <konrness@gmail.com>
 */
class Player
{

    /**
     * @var AbstractDistribution
     */
    protected $distribution;

    /**
     * @var TimePeriod
     */
    protected $timePeriod;

    /**
     * Maximum number of wins allowed in current time period
     *
     * @var int
     */
    protected $maxWins;

    /**
     * Current number of wins awarded in current time period
     *
     * @var int
     */
    protected $curWins = 0;

    /**
     * Current number of plays that have occurred in current time period
     *
     * @var int
     */
    protected $playCount = 0;

    /**
     * Execute one instant-win play and decide if player is a winner
     *
     * @return boolean true = win; false = lose
     */
    public function isWinner()
    {
        if ($this->getCurWins() >= $this->getMaxWins()) {
            return false;
        }

        if ($this->getDistribution() instanceof TimePeriodAwareInterface) {

            /** @var TimePeriodAwareInterface $distribution */
            $distribution = $this->getDistribution();

            $distribution->setTimePeriod($this->getTimePeriod());
        }

        if ($this->getDistribution() instanceof WinAmountAwareInterface) {
            /** @var WinAmountAwareInterface $distribution */
            $distribution = $this->getDistribution();

            $distribution->setCurrentWinCount($this->getCurWins());
            $distribution->setMaxWinCount($this->getMaxWins());
            $distribution->setPlayCount($this->getPlayCount());
        }

        $odds = $this->getDistribution()->getOdds();

//        echo "O: . $odds";

        return $this->generateRandomFloat() <= $odds;
    }

    /**
     * @param \InstantWin\Distribution\AbstractDistribution $distribution
     * @return $this;
     */
    public function setDistribution($distribution)
    {
        $this->distribution = $distribution;
        return $this;
    }

    /**
     * @return \InstantWin\Distribution\AbstractDistribution
     */
    public function getDistribution()
    {
        if (!$this->distribution) {
            throw new \Exception("Distribution not set");
        }
        return $this->distribution;
    }

    /**
     * @param \InstantWin\TimePeriod $timePeriod
     * @return $this;
     */
    public function setTimePeriod($timePeriod)
    {
        $this->timePeriod = $timePeriod;
        return $this;
    }

    /**
     * @throws \Exception
     * @return \InstantWin\TimePeriod
     */
    public function getTimePeriod()
    {
        if (!$this->timePeriod) {
            throw new \Exception("TimePeriod not set");
        }
        return $this->timePeriod;
    }

    /**
     * @param int $curWins
     * @return $this;
     */
    public function setCurWins($curWins)
    {
        $this->curWins = $curWins;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurWins()
    {
        if (null === $this->curWins) {
            throw new \Exception("CurWins not set");
        }
        return $this->curWins;
    }

    /**
     * @param int $maxWins
     * @return $this;
     */
    public function setMaxWins($maxWins)
    {
        $this->maxWins = $maxWins;
        return $this;
    }

    /**
     * @return int
     */
    public function getMaxWins()
    {
        if (!$this->maxWins) {
            throw new \Exception("MaxWins not set");
        }
        return $this->maxWins;
    }

    /**
     * @param int $playCount
     * @return $this;
     */
    public function setPlayCount($playCount)
    {
        $this->playCount = $playCount;
        return $this;
    }

    /**
     * @return int
     */
    public function getPlayCount()
    {
        if (null === $this->playCount) {
            throw new Exception("PlayCount not set");
        }
        return $this->playCount;
    }




    /**
     * Roll the dice
     *
     * @return float
     */
    private function generateRandomFloat()
    {
        return mt_rand(0, 1000000) / 1000000;
    }
}
