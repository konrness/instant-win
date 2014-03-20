<?php

namespace InstantWin\Distribution;


class FixedOddsDistributionTest extends \PHPUnit_Framework_TestCase {

    public function testSetGetFloat()
    {
        $dist = new FixedOddsDistribution();

        $dist->setOdds(0.23);
        $this->assertEquals(0.23, $dist->getOdds());
        $this->assertInternalType('float', $dist->getOdds());
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testSetNonFloat()
    {
        $dist = new FixedOddsDistribution();

        $dist->setOdds("foo");
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testSetInvalidOdds()
    {
        $dist = new FixedOddsDistribution();

        $dist->setOdds(1.5);
    }
}
 