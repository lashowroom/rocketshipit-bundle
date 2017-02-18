<?php

namespace LAShowroom\RocketShipitBundle\Model;

use LAShowroom\RocketShipitBundle\Model\Carrier\Carrier;

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
}
