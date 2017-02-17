<?php

namespace LAShowroom\RocketShipitBundle\Factory;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\ShipmentRequest;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\UpsShipmentRequest;
use RocketShipIt\Shipment;

class ShipmentFactory
{
    /**
     * @var PackageFactory
     */
    private $packageFactory;

    /**
     * @var RocketShipitConfiguration
     */
    private $configuration;

    /**
     * @param PackageFactory            $packageFactory
     * @param RocketShipitConfiguration $configuration
     */
    public function __construct(PackageFactory $packageFactory, RocketShipitConfiguration $configuration)
    {
        $this->packageFactory = $packageFactory;
        $this->configuration = $configuration;
    }

    public function createShipment(ShipmentRequest $shipmentRequest)
    {
        $shipment = new Shipment($shipmentRequest->getCarrier()->__toString(), $this->configuration->getConfiguration());
        $shipment->setParameter('toCompany', $shipmentRequest->getDestinationAddress()->getCompany());
        $shipment->setParameter('toName', $shipmentRequest->getDestinationAddress()->getName());
        $shipment->setParameter('toAddr1', $shipmentRequest->getDestinationAddress()->getAddress1());
        $shipment->setParameter('toAddr2', $shipmentRequest->getDestinationAddress()->getAddress2());
        $shipment->setParameter('toCity', $shipmentRequest->getDestinationAddress()->getCity());
        $shipment->setParameter('toState', $shipmentRequest->getDestinationAddress()->getState());
        $shipment->setParameter('toCode', $shipmentRequest->getDestinationAddress()->getZipcode());
        $shipment->setParameter('toCountry', $shipmentRequest->getDestinationAddress()->getCountry());

        $shipment->setParameter('shipper', $shipmentRequest->getSourceAddress()->getName());
        $shipment->setParameter('shipContact', $shipmentRequest->getSourceAddress()->getContact());
        $shipment->setParameter('shipPhone', $shipmentRequest->getSourceAddress()->getPhone());
        $shipment->setParameter('shipAddr1', $shipmentRequest->getSourceAddress()->getAddress1());
        $shipment->setParameter('shipAddr2', $shipmentRequest->getSourceAddress()->getAddress2());
        $shipment->setParameter('shipCity', $shipmentRequest->getSourceAddress()->getCity());
        $shipment->setParameter('shipState', $shipmentRequest->getSourceAddress()->getState());
        $shipment->setParameter('shipCode', $shipmentRequest->getSourceAddress()->getZipcode());

        if ($shipmentRequest instanceof UpsShipmentRequest) {
            $shipment->setParameter('pickupType', $shipmentRequest->getPickupType());
        }

        $shipment->setParameter('verifyAddress', $shipmentRequest->isAddressVerificationEnabled() ? 'validate' : 'nonvalidate');

        foreach ($shipmentRequest->getPackages() as $package) {
            $shipment->setParameter('lengthUnit', $package->getDimensions()->getUnit());
            $shipment->addPackageToShipment($this->packageFactory->createPackage($shipmentRequest->getCarrier(), $package));
        }

        $shipment->setParameter('service', $shipmentRequest->getServiceCode());
        $shipment->setParameter('negotiatedRates', $shipmentRequest->isNegotiatedRates());

        return $shipment;
    }
}
