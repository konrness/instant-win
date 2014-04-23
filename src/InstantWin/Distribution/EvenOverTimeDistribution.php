<?php
/**
 * Created by PhpStorm.
 * User: kness
 * Date: 3/20/14
 * Time: 11:59 AM
 */

namespace InstantWin\Distribution;


use InstantWin\TimePeriod;

class EvenOverTimeDistribution extends AbstractDistribution
    implements TimePeriodAwareInterface, WinAmountAwareInterface
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
        $winsPercentage = $this->getCurrentWinCount() / $this->getMaxWinCount();
        $timePercentage = $this->getTimePeriod()->getCompletion();

        $desiredWinCount = $timePercentage * $this->getMaxWinCount();
//
//        echo "DW: $desiredWinCount, ";
//        echo "AW: " . $this->getCurrentWinCount() . ", ";

        // this assumes a linear distribution of plays throughout the day
        $estimatedRemainingPlays = ($this->getPlayCount() / $timePercentage) - $this->getPlayCount();
        $estimatedRemainingPlays = max(1, $estimatedRemainingPlays);

//        echo "ERP: $estimatedRemainingPlays, ";

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
     * @return int
     */
    public function getPlayCount()
    {
        if (null === $this->playCount) {
            throw new Exception("PlayCount not set");
        }
        return $this->playCount;
    }



} 