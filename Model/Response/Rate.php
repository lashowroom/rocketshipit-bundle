<?php

namespace LAShowroom\RocketShipitBundle\Model\Response;

use Money\Money;

class Rate
{
    /**
     * @var string
     */
    private $serviceCode;

    /**
     * @var string
     */
    private $serviceDescription;

    /**
     * @var Money
     */
    private $transportationCharges;

    /**
     * @var Money
     */
    private $serviceOptionCharges;

    /**
     * @var Money
     */
    private $totalCharges;

    /**
     * @var Money
     */
    private $negotiatedRate;

    /**
     * @param string $serviceCode
     * @param string $serviceDescription
     * @param Money  $transportationCharges
     * @param Money  $serviceOptionCharges
     * @param Money  $totalCharges
     * @param Money  $negotiatedRate
     */
    public function __construct($serviceCode, $serviceDescription, Money $transportationCharges, Money $serviceOptionCharges, Money $totalCharges, Money $negotiatedRate)
    {
        $this->serviceCode = $serviceCode;
        $this->serviceDescription = $serviceDescription;
        $this->transportationCharges = $transportationCharges;
        $this->serviceOptionCharges = $serviceOptionCharges;
        $this->totalCharges = $totalCharges;
        $this->negotiatedRate = $negotiatedRate;
    }

    /**
     * @return string
     */
    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    /**
     * @return Money
     */
    public function getTransportationCharges(): Money
    {
        return $this->transportationCharges;
    }

    /**
     * @return Money
     */
    public function getServiceOptionCharges(): Money
    {
        return $this->serviceOptionCharges;
    }

    /**
     * @return Money
     */
    public function getTotalCharges(): Money
    {
        return $this->totalCharges;
    }

    /**
     * @return Money
     */
    public function getNegotiatedRate(): Money
    {
        return $this->negotiatedRate;
    }

    /**
     * @return string
     */
    public function getServiceDescription(): string
    {
        return $this->serviceDescription;
    }
}
