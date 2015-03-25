<?php

namespace InstantWin\Distribution;

/**
 * Defines distribution logic for awarding wins by using fixed odds. This will not attempt
 * to spread the wins evenly over a time period.
 *
 * @author Konr Ness <konrness@gmail.com>
 */
class FixedOddsDistribution extends AbstractDistribution
{

    /**
     * @var float
     */
    protected $_odds;

    /**
     * Get the odds for a single play at this moment in time
     *
     * @return float Number from 0.000 to 0.999
     * @throws \Exception if odds are not set
     */
    public function getOdds()
    {
        if (null === $this->_odds) {
            throw new Exception("Odds not set");
        }

        return $this->_odds;
    }

    /**
     * Sets the fixed odds for all plays
     *
     * @param float|double $odds
     * @return $this
     * @throws \UnexpectedValueException
     */
    public function setOdds($odds)
    {
        if (! is_numeric($odds)) {
            throw new \UnexpectedValueException("Odds expected to be float. " . gettype($odds) . " provided.");
        }

        if ($odds > 1 || $odds < 0) {
            throw new \UnexpectedValueException("Odds expected to be between 0.00 and 0.999");
        }

        $this->_odds = (float) $odds;
        return $this;
    }
}
