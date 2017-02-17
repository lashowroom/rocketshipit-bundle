<?php

namespace LAShowroom\RocketShipitBundle\Factory;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Model\RateRequest;
use RocketShipIt\Rate;

class RateFactory
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

    public function createRateRequest(RateRequest $rateRequest)
    {
        $rate = new Rate($rateRequest->getCarrier()->__toString(), $this->configuration->getConfiguration());
        $rate->setParameter('toCity', $rateRequest->getDestinationCity());
        $rate->setParameter('toState', $rateRequest->getDestinationState());
        $rate->setParameter('toCode', $rateRequest->getDestinationZipcode());
        $rate->setParameter('negotiatedRates', $rateRequest->isNegotiatedRates());
        $rate->setParameter('shipCode', $rateRequest->getSourceZipcode());

        foreach ($rateRequest->getPackages() as $package) {
            $rate->addPackageToShipment($this->packageFactory->createPackage($rateRequest->getCarrier(), $package));
        }

        return $rate;
    }
}
