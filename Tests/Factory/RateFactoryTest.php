<?php

namespace LAShowroom\RocketShipitBundle\Tests\Factory;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Factory\PackageFactory;
use LAShowroom\RocketShipitBundle\Factory\RateFactory;
use LAShowroom\RocketShipitBundle\Model\Address;
use LAShowroom\RocketShipitBundle\Model\Carrier\Ups;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Cuboid;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Weight;
use LAShowroom\RocketShipitBundle\Model\Package;
use LAShowroom\RocketShipitBundle\Model\RateRequest;
use RocketShipIt\Rate;

class RateFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testRate()
    {
        $factory = new RateFactory(new PackageFactory(new RocketShipitConfiguration([])), new RocketShipitConfiguration([]));

        $sourceAddress = new Address('company', 'name', 'contact', 'address1', 'address2', 'city', 'state', 'zipcode', 'country', 'phone');
        $destinationAddress = new Address('company2', 'name2', 'contact2', 'address12', 'address22', 'city2', 'state2', 'zipcode2', 'country2', 'phone2');

        $rateRequest = new RateRequest($sourceAddress, $destinationAddress, false, new Ups());

        $rateRequest->addPackage(
            new Package(new Weight(1.1, Weight::UNIT_LBS), new Cuboid(1, 2, 3, Cuboid::UNIT_INCH), 'doge')
        );

        $rate = $factory->createRate($rateRequest);

        $this->assertInstanceOf(Rate::class, $rate);

        $expectedPackage = new \RocketShipIt\Package('UPS', ['config' => new RocketShipitConfiguration([])]);

        $this->assertEquals([$expectedPackage], $rate->packages);

        print_r($rate);

//        [packages] => Array
//    (
//        [0] => RocketShipIt\Package Object
//    (
//        [carrier] => UPS
//    [configuration] => Array
//    (
//        [config] => RocketShipIt\Config Object
//    (
//        [parameters] => Array
//    (
//    )
//
//                                )
//
//                        )
//
//                    [parameters] => Array
//    (
//        [weight] => 1.1
//                            [height] => 1
//                            [length] => 2
//                            [width] => 3
//                            [packagingType] => doge
//                        )
//
//                )
//
//        )
//
//    [carrier] => UPS
//    [configuration] => Array
//    (
//        [config] => RocketShipIt\Config Object
//    (
//        [parameters] => Array
//    (
//    )
//
//                )
//
//        )
//
//    [parameters] => Array
//    (
//        [toCity] => city2
//        [toState] => state2
//    [toCode] => zipcode2
//    [negotiatedRates] =>
//            [shipCode] => zipcode
//        )
//
//)

//        $rate = $factory->createRateRequest(
//            new Ups(),
//            new Package(new Weight(1.1, Weight::UNIT_LBS), new Cuboid(1, 2, 3, Cuboid::UNIT_INCH), 'doge')
//        );
//
//        $this->assertEquals('UPS', $package->carrier);
//        $this->assertEquals([
//            'weight' => 1.1,
//            'height' => 1,
//            'length' => 2,
//            'width' => 3,
//            'packagingType' => 'doge',
//        ], $package->parameters);
    }
}
