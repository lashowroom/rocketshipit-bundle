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
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateRequest;
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

        $this->assertEquals('city2', $rate->parameters['toCity']);
        $this->assertEquals('state2', $rate->parameters['toState']);
        $this->assertEquals('zipcode2', $rate->parameters['toCode']);
        $this->assertEquals('zipcode', $rate->parameters['shipCode']);
    }
}
