<?php
/**
 * Created by PhpStorm.
 * User: kness
 * Date: 4/24/14
 * Time: 2:05 PM
 */

namespace InstantWin;


class TimePeriodTest extends \PHPUnit_Framework_TestCase {

    public function testEndTimestampSetGet()
    {
        $timePeriod = new TimePeriod();

        $timePeriod->setEndTimestamp(1234);

        $this->assertEquals(1234, $timePeriod->getEndTimestamp());
    }

    public function testStartTimestampSetGet()
    {
        $timePeriod = new TimePeriod();

        $timePeriod->setStartTimestamp(1234);

        $this->assertEquals(1234, $timePeriod->getStartTimestamp());
    }

    public function testCurrentTimestampSetGet()
    {
        $timePeriod = new TimePeriod();

        $timePeriod->setCurrentTimestamp(1234);

        $this->assertEquals(1234, $timePeriod->getCurrentTimestamp());
    }

    /**
     * @expectedException \Exception
     */
    public function testEmptyStartGetFails()
    {
        $timePeriod = new TimePeriod();

        $timePeriod->getStartTimestamp();
    }

    /**
     * @expectedException \Exception
     */
    public function testEmptyEndGetFails()
    {
        $timePeriod = new TimePeriod();

        $timePeriod->getEndTimestamp();
    }

    public function testEmptyCurrentGetProvidesCurrentTime()
    {
        $timePeriod = new TimePeriod();

        // intentional fail to test Bamboo
        $this->assertEquals(5, $timePeriod->getCurrentTimestamp());
        $this->assertEquals(time(), $timePeriod->getCurrentTimestamp());
    }

    public function testCompletionCorrect()
    {
        $timePeriod = new TimePeriod();

        $timePeriod->setStartTimestamp(100);
        $timePeriod->setEndTimestamp(200);
        $timePeriod->setCurrentTimestamp(150);

        $this->assertEquals(0.5, $timePeriod->getCompletion());
    }

}
 