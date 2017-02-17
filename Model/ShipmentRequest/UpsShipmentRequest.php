<?php

namespace LAShowroom\RocketShipitBundle\Model\ShipmentRequest;

use LAShowroom\RocketShipitBundle\Model\Carrier\Ups;

class UpsShipmentRequest extends ShipmentRequest
{
    /**
     * @var string
     */
    protected $pickupType;

    /**
     * @return string
     */
    public function getPickupType(): string
    {
        return $this->pickupType;
    }

    /**
     * @param string $pickupType
     */
    public function setPickupType(string $pickupType)
    {
        if (!Ups::isValidPickupType($pickupType)) {
            throw new \InvalidArgumentException('Invalid Pickup Type: ' . $pickupType);
        }

        $this->pickupType = $pickupType;
    }
}
