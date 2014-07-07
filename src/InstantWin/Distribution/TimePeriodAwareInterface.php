<?php
/**
 * Created by PhpStorm.
 * User: kness
 * Date: 3/20/14
 * Time: 11:57 AM
 */

namespace InstantWin\Distribution;

use InstantWin\TimePeriod;

interface TimePeriodAwareInterface
{
    /**
     * @param TimePeriod $timePeriod
     * @return mixed
     */
    public function setTimePeriod($timePeriod);
}
