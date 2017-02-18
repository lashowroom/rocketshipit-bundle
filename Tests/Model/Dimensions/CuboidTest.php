<?php

namespace LAShowroom\RocketShipitBundle\Tests\Model\Dimensions;

use LAShowroom\RocketShipitBundle\Model\Dimensions\Cuboid;

class CuboidTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedExceptionMessage Invalid unit: doge
     * @expectedException \InvalidArgumentException
     */
    public function testIncorrectUnit()
    {
        new Cuboid(1, 2, 3, 'doge');
    }
}
