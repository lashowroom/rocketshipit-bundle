<?php

namespace LAShowroom\RocketShipitBundle\Model\RateRequest;

use LAShowroom\RocketShipitBundle\Model\Address;
use LAShowroom\RocketShipitBundle\Model\Carrier\Carrier;
use LAShowroom\RocketShipitBundle\Model\Package;

class RateRequest
{
    /**
     * @var Address
     */
    private $sourceAddress;

    /**
     * @var Address
     */
    private $destinationAddress;

    /**
     * @var bool
     */
    private $negotiatedRates;

    /**
     * @var Package[]
     */
    private $packages;

    /**
     * @var Carrier
     */
    private $carrier;

    /**
     * @param Address $sourceAddress
     * @param Address $destinationAddress
     * @param bool    $negotiatedRates
     * @param Carrier $carrier
     */
    public function __construct(Address $sourceAddress, Address $destinationAddress, $negotiatedRates, Carrier $carrier)
    {
        $this->sourceAddress = $sourceAddress;
        $this->destinationAddress = $destinationAddress;
        $this->negotiatedRates = $negotiatedRates;
        $this->carrier = $carrier;
        $this->packages = [];
    }

    public function addPackage(Package $package)
    {
        $this->packages[] = $package;
    }

    /**
     * @return bool
     */
    public function isNegotiatedRates(): bool
    {
        return $this->negotiatedRates;
    }

    /**
     * @return Package[]
     */
    public function getPackages(): array
    {
        return $this->packages;
    }

    /**
     * @return Carrier
     */
    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }

    /**
     * @return Address
     */
    public function getSourceAddress(): Address
    {
        return $this->sourceAddress;
    }

    /**
     * @return Address
     */
    public function getDestinationAddress(): Address
    {
        return $this->destinationAddress;
    }

    public function getCacheKey()
    {
        return md5(json_encode(
            [
                'source' => $this->sourceAddress,
                'destination' => $this->destinationAddress,
                'negotiatedRates' => $this->negotiatedRates,
                'carrier' => $this->carrier,
                'packages' => $this->packages,
            ]
        ));
    }
}
