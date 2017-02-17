<?php

namespace LAShowroom\RocketShipitBundle\Factory;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;
use LAShowroom\RocketShipitBundle\Model\Carrier\Carrier;
use LAShowroom\RocketShipitBundle\Model\Package;
use RocketShipIt\Package as RocketShipitPackage;

class PackageFactory
{
    /**
     * @var RocketShipitConfiguration
     */
    private $configuration;

    /**
     * @param RocketShipitConfiguration $configuration
     */
    public function __construct(RocketShipitConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function createPackage(Carrier $carrier, Package $package)
    {
        $rocketPackage = new RocketShipitPackage($carrier->__toString(), $this->configuration->getConfiguration());
        $rocketPackage->setParameter('weight', $package->getWeight()->getWeight());
        $rocketPackage->setParameter('height', $package->getDimensions()->getHeight());
        $rocketPackage->setParameter('length', $package->getDimensions()->getLength());
        $rocketPackage->setParameter('width', $package->getDimensions()->getWidth());

        $rocketPackage->setParameter('packagingType', $package->getPackagingType());
        
        return $rocketPackage;
    }
}
