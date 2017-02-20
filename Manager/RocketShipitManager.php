<?php

namespace LAShowroom\RocketShipitBundle\Manager;

use LAShowroom\RocketShipitBundle\Factory\RateFactory;
use LAShowroom\RocketShipitBundle\Factory\ShipmentFactory;
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateRequest;
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateResponse;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\ShipmentRequest;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\ShipmentResponse;

class RocketShipitManager
{
    /**
     * @var RateFactory
     */
    private $rateFactory;

    /**
     * @var ShipmentFactory
     */
    private $shipmentFactory;

    /**
     * @param RateFactory     $rateFactory
     * @param ShipmentFactory $shipmentFactory
     */
    public function __construct(RateFactory $rateFactory, ShipmentFactory $shipmentFactory)
    {
        $this->rateFactory = $rateFactory;
        $this->shipmentFactory = $shipmentFactory;
    }

    public function getRates(RateRequest $rateRequest)
    {
        $rate = $this->rateFactory->createRate($rateRequest);

        $response = $rate->getAllRates();

        if (!empty($response['RatingServiceSelectionResponse']) &&
            !empty($response['RatingServiceSelectionResponse']['Response']['ResponseStatusDescription']) &&
            'Success' === $response['RatingServiceSelectionResponse']['Response']['ResponseStatusDescription']
        ) {
            return new RateResponse($rateRequest, $response);
        }

        throw new \Exception($response);
    }

    public function getLabel(ShipmentRequest $shipmentRequest)
    {
        $shipment = $this->shipmentFactory->createShipment($shipmentRequest);

        $response = $shipment->submitShipment();

        return new ShipmentResponse($shipmentRequest, $response);
    }
}
