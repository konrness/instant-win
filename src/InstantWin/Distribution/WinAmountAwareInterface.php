<?php

namespace InstantWin\Distribution;


interface WinAmountAwareInterface {
    /**
     * @param int $currentWinCount
     */
    public function setCurrentWinCount($currentWinCount);

    /**
     * @param int $playCount
     */
    public function setPlayCount($playCount);

    /**
     * @param int $maxWinCount
     */
    public function setMaxWinCount($maxWinCount);

} 