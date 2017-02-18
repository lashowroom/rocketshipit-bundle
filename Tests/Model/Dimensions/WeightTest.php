<?php

namespace LAShowroom\RocketShipitBundle\Tests\Model\Dimensions;

use LAShowroom\RocketShipitBundle\Model\Dimensions\Weight;

class WeightTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedExceptionMessage Invalid unit: doge
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrectUnit()
    {
        new Weight(1, 'doge');
    }

    public function testCorrectUnit()
    {
        $weight = new Weight(1, Weight::UNIT_LBS);
        $this->assertEquals(Weight::UNIT_LBS, $weight->getUnit());
    }
}
