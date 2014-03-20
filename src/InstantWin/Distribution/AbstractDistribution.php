<?php

namespace InstantWin\Distribution;

/**
 * Defines standard functionality for spreading wins over a time period
 *
 * @author Konr Ness <konrness@gmail.com>
 */
abstract class AbstractDistribution {

    /**
     * Get the odds for a single play at this moment in time
     *
     * @return float Number from 0.000 to 0.999
     */
    abstract public function getOdds();

}