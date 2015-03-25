<?php

namespace InstantWin\Distribution;

use InstantWin\TimePeriod;

/**
 * Defines distribution logic for spreading wins evenly over a time period when
 * the number of total plays in the time period can not be known.
 *
 * @author Konr Ness <konrness@gmail.com>
 */
class EvenOverTimeDistribution extends AbstractDistribution implements
    TimePeriodAwareInterface,
    WinAmountAwareInterface
{
    const MIN_ODDS = 0.00001;

    /**
     * @var TimePeriod
     */
    protected $timePeriod;

    /**
     * @var int
     */
    protected $currentWinCount;

    /**
     * @var int
     */
    protected $playCount;

    /**
     * @var int
     */
    protected $maxWinCount;

    /**
     * Get the odds for a single play at this moment in time
     *
     * @return float Number from 0.000 to 0.999
     */
    public function getOdds()
    {
        // determine percentage of wins awarded
        $timePercentage = $this->getTimePeriod()->getCompletion();

        $desiredWinCount = $timePercentage * $this->getMaxWinCount();

        // this assumes a linear distribution of plays throughout the day
        $estimatedRemainingPlays = ($this->getPlayCount() / $timePercentage) - $this->getPlayCount();
        $estimatedRemainingPlays = max(1, $estimatedRemainingPlays);

        return ($desiredWinCount - $this->getCurrentWinCount()) / $estimatedRemainingPlays * 5;

    }

    /**
     * @param TimePeriod $timePeriod
     * @return $this
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
     * @param int $currentWinCount
     */
    public function setCurrentWinCount($currentWinCount)
    {
        $this->currentWinCount = $currentWinCount;
    }

    /**
     * @param int $maxWinCount
     */
    public function setMaxWinCount($maxWinCount)
    {
        $this->maxWinCount = $maxWinCount;
    }

    /**
     * @throws \Exception
     * @return int
     */
    public function getCurrentWinCount()
    {
        if (null === $this->currentWinCount) {
            throw new \Exception("CurrentWinCount not set");
        }
        return $this->currentWinCount;
    }

    /**
     * @throws \Exception
     * @return int
     */
    public function getMaxWinCount()
    {
        if (null === $this->maxWinCount) {
            throw new \Exception("MaxWinCount not set");
        }
        return $this->maxWinCount;
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
     * @throws \Exception
     * @return int
     */
    public function getPlayCount()
    {
        if (null === $this->playCount) {
            throw new \Exception("PlayCount not set");
        }
        return $this->playCount;
    }
}
