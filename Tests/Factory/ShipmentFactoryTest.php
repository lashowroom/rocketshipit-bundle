<?php

namespace LAShowroom\RocketShipitBundle\Tests\Factory;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Factory\PackageFactory;
use LAShowroom\RocketShipitBundle\Factory\ShipmentFactory;
use LAShowroom\RocketShipitBundle\Model\Address;
use LAShowroom\RocketShipitBundle\Model\Carrier\Ups;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Cuboid;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Weight;
use LAShowroom\RocketShipitBundle\Model\Package;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\UpsShipmentRequest;
use RocketShipIt\Shipment;

class ShipmentFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testRate()
    {
        $factory = new ShipmentFactory(new PackageFactory(new RocketShipitConfiguration([])), new RocketShipitConfiguration([]));

        $sourceAddress = new Address('company', 'name', 'contact', 'address1', 'address2', 'city', 'state', 'zipcode', 'country', 'phone');
        $destinationAddress = new Address('company2', 'name2', 'contact2', 'address12', 'address22', 'city2', 'state2', 'zipcode2', 'country2', 'phone2');

        $shipmentRequest = new UpsShipmentRequest($sourceAddress, $destinationAddress, new Ups(), '03');
        $shipmentRequest->setPickupType(Ups::PICKUP_TYPE_CUSTOMER_COUNTER);

        $shipmentRequest->addPackage(
            new Package(new Weight(1.1, Weight::UNIT_LBS), new Cuboid(1, 2, 3, Cuboid::UNIT_INCH), 'doge')
        );

        $shipment = $factory->createShipment($shipmentRequest);

        $this->assertInstanceOf(Shipment::class, $shipment);

        $this->assertEquals('IN', $shipment->parameters['lengthUnit']);
        $this->assertEquals('03', $shipment->parameters['service']);
        $this->assertEquals('03', $shipment->parameters['pickupType']);
    }
}
