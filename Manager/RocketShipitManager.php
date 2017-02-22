<?php

namespace LAShowroom\RocketShipitBundle\Manager;

use LAShowroom\RocketShipitBundle\Factory\RateFactory;
use LAShowroom\RocketShipitBundle\Factory\ShipmentFactory;
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateRequest;
use LAShowroom\RocketShipitBundle\Model\RateRequest\RateResponse;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\ShipmentRequest;
use LAShowroom\RocketShipitBundle\Model\ShipmentRequest\ShipmentResponse;
use Psr\Cache\CacheItemPoolInterface;

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
     * @var CacheItemPoolInterface
     */
    private $cacheItemPool;

    /**
     * @param RateFactory     $rateFactory
     * @param ShipmentFactory $shipmentFactory
     */
    public function __construct(RateFactory $rateFactory, ShipmentFactory $shipmentFactory)
    {
        $this->rateFactory = $rateFactory;
        $this->shipmentFactory = $shipmentFactory;
    }

    /**
     * @param CacheItemPoolInterface $cacheItemPool
     */
    public function setCacheItemPool(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }

    public function getRates(RateRequest $rateRequest)
    {
        if (null === $this->cacheItemPool) {
            return $this->getRatesFromRocketshipit($rateRequest);
        }

        /** @var \Symfony\Component\Cache\CacheItem $cacheItem */
        $cacheItem = $this->cacheItemPool->getItem($rateRequest->getCacheKey());
        if (!$cacheItem->isHit()) {
            $cacheItem->set($this->getRatesFromRocketshipit($rateRequest));
            $this->cacheItemPool->save($cacheItem);
            $cacheItem->expiresAt(new \DateTime('+1 day'));
        }

        return $cacheItem->get();
    }

    public function getLabel(ShipmentRequest $shipmentRequest)
    {
        $shipment = $this->shipmentFactory->createShipment($shipmentRequest);

        $response = $shipment->submitShipment();

        return new ShipmentResponse($shipmentRequest, $response);
    }

    private function getRatesFromRocketshipit(RateRequest $rateRequest)
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
}
