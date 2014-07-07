<?php

namespace InstantWin;


class TimePeriod
{

    /**
     * Timestamp of the beginning of the current time period
     *
     * @var int
     */
    protected $startTimestamp;

    /**
     * Timestamp of the end of the current time period
     *
     * @var int
     */
    protected $endTimestamp;

    /**
     * Allows for forcing the current timestamp for testing
     *
     * @var int|null
     */
    protected $currentTimestamp = null;

    /**
     * @return float
     */
    public function getCompletion()
    {
        // force completion to be greater than 0
        return max(1, $this->getCurrentTimestamp() - $this->getStartTimestamp()) / $this->getDuration();
    }

    /**
     * @param int $endTimestamp
     * @return $this;
     */
    public function setEndTimestamp($endTimestamp)
    {
        $this->endTimestamp = $endTimestamp;
        return $this;
    }

    /**
     * @return int
     */
    public function getEndTimestamp()
    {
        if (!$this->endTimestamp) {
            throw new \Exception("EndTimestamp not set");
        }
        return $this->endTimestamp;
    }

    /**
     * @param int $startTimestamp
     * @return $this;
     */
    public function setStartTimestamp($startTimestamp)
    {
        $this->startTimestamp = $startTimestamp;
        return $this;
    }

    /**
     * @return int
     */
    public function getStartTimestamp()
    {
        if (!$this->startTimestamp) {
            throw new \Exception("StartTimestamp not set");
        }
        return $this->startTimestamp;
    }

    /**
     * @param int $currentTimestamp
     * @return $this;
     */
    public function setCurrentTimestamp($currentTimestamp)
    {
        $this->currentTimestamp = $currentTimestamp;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentTimestamp()
    {
        if (null === $this->currentTimestamp) {
            return time();
        }

        return $this->currentTimestamp;
    }



    /**
     * @return int
     */
    protected function getDuration()
    {
        return $this->getEndTimestamp() - $this->getStartTimestamp();
    }
}
