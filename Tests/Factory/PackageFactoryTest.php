<?php

namespace LAShowroom\RocketShipitBundle\Tests\Factory;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Factory\PackageFactory;
use LAShowroom\RocketShipitBundle\Model\Carrier\Ups;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Cuboid;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Weight;
use LAShowroom\RocketShipitBundle\Model\Package;

class PackageFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testPackage()
    {
        $factory = new PackageFactory(new RocketShipitConfiguration([]));

        $package = $factory->createPackage(
            new Ups(),
            new Package(new Weight(1.1, Weight::UNIT_LBS), new Cuboid(1, 2, 3, Cuboid::UNIT_INCH), 'doge')
        );

        $this->assertEquals('UPS', $package->carrier);
        $this->assertEquals([
            'weight' => 1.1,
            'height' => 1,
            'length' => 2,
            'width' => 3,
            'packagingType' => 'doge',
        ], $package->parameters);
    }
}
