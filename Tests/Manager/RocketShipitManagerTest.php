<?php

namespace LAShowroom\RocketShipitBundle\Tests\Manager;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Factory\PackageFactory;
use LAShowroom\RocketShipitBundle\Factory\RateFactory;
use LAShowroom\RocketShipitBundle\Factory\ShipmentFactory;
use LAShowroom\RocketShipitBundle\Manager\RocketShipitManager;
use LAShowroom\RocketShipitBundle\Model\Address;
use LAShowroom\RocketShipitBundle\Model\Carrier\Ups;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Cuboid;
use LAShowroom\RocketShipitBundle\Model\Dimensions\Weight;
use LAShowroom\RocketShipitBundle\Model\Package;
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateRequest;
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateResponse;
use LAShowroom\RocketShipitBundle\Model\Response\Rate;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\Label;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\ShipmentResponse;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\UpsShipmentRequest;
use Money\Currency;
use Money\Money;

class RocketShipitManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testGetLabel()
    {
        $shipmentRequest = new UpsShipmentRequest($this->getSourceAddress(), $this->getDestinationAddress(), new Ups(), '03');
        $shipmentRequest->setPickupType(Ups::PICKUP_TYPE_CUSTOMER_COUNTER);
        $shipmentRequest->setNegotiatedRates(true);
        $shipmentRequest->setAddressVerificationEnabled(true);

        $shipmentRequest->addPackage(
            new Package(new Weight(1.1, Weight::UNIT_LBS), new Cuboid(1, 2, 3, Cuboid::UNIT_INCH), 'doge')
        );

        $response = $this->getManager()->getLabel($shipmentRequest);

        $this->assertInstanceOf(ShipmentResponse::class, $response);
        $this->assertEquals(new Money(123, new Currency('USD')), $response->getCharges());
        $this->assertEquals(new Money(102, new Currency('USD')), $response->getNegotiatedCharges());
        $this->assertEquals('main_tracking_number', $response->getMainTrackingNumber());
        foreach ($response->getLabels() as $label) {
            $this->assertInstanceOf(Label::class, $label);
        }
        $this->assertEquals('track_1', $response->getLabels()[0]->getTrackingNumber());
        $this->assertEquals('fmt_1', $response->getLabels()[0]->getLabelFormat());
        $this->assertEquals('image_1', $response->getLabels()[0]->getLabelImage());
        $this->assertEquals('track_2', $response->getLabels()[1]->getTrackingNumber());
        $this->assertEquals('fmt_2', $response->getLabels()[1]->getLabelFormat());
        $this->assertEquals('image_2', $response->getLabels()[1]->getLabelImage());
    }

    public function testGetRates()
    {
        $rateRequest = new RateRequest($this->getSourceAddress(), $this->getDestinationAddress(), true, new Ups());

        $response = $this->getManager()->getRates($rateRequest);

        $this->assertInstanceOf(RateResponse::class, $response);

        foreach ($response->getRates() as $rate) {
            $this->assertInstanceOf(Rate::class, $rate);
        }

        $this->assertEquals('03', $response->getRates()[0]->getServiceCode());
        $this->assertEquals('UPS Ground', $response->getRates()[0]->getServiceDescription());
        $this->assertEquals(new Money(123, new Currency('USD')), $response->getRates()[0]->getTransportationCharges());
        $this->assertEquals(new Money(156, new Currency('USD')), $response->getRates()[0]->getTotalCharges());
        $this->assertEquals(new Money(145, new Currency('USD')), $response->getRates()[0]->getServiceOptionCharges());
        $this->assertEquals(new Money(167, new Currency('USD')), $response->getRates()[0]->getNegotiatedRate());
    }

    /**
     * @return RocketShipitManager
     */
    private function getManager(): RocketShipitManager
    {
        $shipmentFactory = new ShipmentFactory(new PackageFactory(new RocketShipitConfiguration([])), new RocketShipitConfiguration([]));
        $rateFactory = new RateFactory(new PackageFactory(new RocketShipitConfiguration([])), new RocketShipitConfiguration([]));

        $manager = new RocketShipitManager($rateFactory, $shipmentFactory);

        return $manager;
    }

    /**
     * @return Address
     */
    private function getSourceAddress(): Address
    {
        $sourceAddress = new Address('company', 'name', 'contact', 'address1', 'address2', 'city', 'state', 'zipcode', 'country', 'phone');

        return $sourceAddress;
    }

    /**
     * @return Address
     */
    private function getDestinationAddress(): Address
    {
        $destinationAddress = new Address('company2', 'name2', 'contact2', 'address12', 'address22', 'city2', 'state2', 'zipcode2', 'country2', 'phone2');

        return $destinationAddress;
    }
}
