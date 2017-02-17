<?php

namespace LAShowroom\RocketShipitBundle\Model;

use LAShowroom\RocketShipitBundle\Model\Carrier\Carrier;

class RateRequest
{
    /**
     * @var string
     */
    private $sourceZipcode;

    /**
     * @var string
     */
    private $destinationZipcode;

    /**
     * @var string
     */
    private $destinationCity;

    /**
     * @var string
     */
    private $destinationState;

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
     * @param string $sourceZipcode
     * @param string $destinationZipcode
     * @param string $destinationCity
     * @param string $destinationState
     * @param bool   $negotiatedRates
     * @param Carrier $carrier
     */
    public function __construct($sourceZipcode, $destinationZipcode, $destinationCity, $destinationState, $negotiatedRates, Carrier $carrier)
    {
        $this->sourceZipcode = $sourceZipcode;
        $this->destinationZipcode = $destinationZipcode;
        $this->destinationCity = $destinationCity;
        $this->destinationState = $destinationState;
        $this->negotiatedRates = $negotiatedRates;
        $this->carrier = $carrier;
    }

    public function addPackage(Package $package)
    {
        $this->packages[] = $package;
    }

    /**
     * @return string
     */
    public function getSourceZipcode(): string
    {
        return $this->sourceZipcode;
    }

    /**
     * @return string
     */
    public function getDestinationZipcode(): string
    {
        return $this->destinationZipcode;
    }

    /**
     * @return string
     */
    public function getDestinationCity(): string
    {
        return $this->destinationCity;
    }

    /**
     * @return string
     */
    public function getDestinationState(): string
    {
        return $this->destinationState;
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
}
