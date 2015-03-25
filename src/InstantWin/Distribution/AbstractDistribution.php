<?php

namespace InstantWin\Distribution;

abstract class AbstractDistribution
{

    /**
     * Get the odds for a single play at this moment in time
     *
     * @return float Number from 0.000 to 0.999
     */
    abstract public function getOdds();
}
