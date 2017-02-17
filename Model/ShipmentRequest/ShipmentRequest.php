<?php

namespace LAShowroom\RocketShipitBundle\Model\ShipmentRequest;

use LAShowroom\RocketShipitBundle\Model\Address;
use LAShowroom\RocketShipitBundle\Model\Carrier\Carrier;
use LAShowroom\RocketShipitBundle\Model\Package;

class ShipmentRequest
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
     * @var Carrier
     */
    private $carrier;

    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var Package[]
     */
    private $packages;

    /**
     * @var bool
     */
    private $addressVerificationEnabled = false;

    /**
     * @var bool
     */
    private $negotiatedRates = false;

    /**
     * @param Address $sourceAddress
     * @param Address $destinationAddress
     * @param Carrier $carrier
     * @param string  $serviceCode
     */
    public function __construct(Address $sourceAddress, Address $destinationAddress, Carrier $carrier, $serviceCode)
    {
        $this->sourceAddress = $sourceAddress;
        $this->destinationAddress = $destinationAddress;
        $this->carrier = $carrier;
        $this->serviceCode = $serviceCode;
    }

    public function addPackage(Package $package)
    {
        $this->packages[] = $package;
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

    /**
     * @return Carrier
     */
    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }

    /**
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * @return Package[]
     */
    public function getPackages(): array
    {
        return $this->packages;
    }

    /**
     * @return bool
     */
    public function isAddressVerificationEnabled(): bool
    {
        return $this->addressVerificationEnabled;
    }

    /**
     * @param bool $addressVerificationEnabled
     */
    public function setAddressVerificationEnabled(bool $addressVerificationEnabled)
    {
        $this->addressVerificationEnabled = $addressVerificationEnabled;
    }

    /**
     * @return bool
     */
    public function isNegotiatedRates(): bool
    {
        return $this->negotiatedRates;
    }

    /**
     * @param bool $negotiatedRates
     */
    public function setNegotiatedRates(bool $negotiatedRates)
    {
        $this->negotiatedRates = $negotiatedRates;
    }
}
