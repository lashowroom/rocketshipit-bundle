<?php

namespace LAShowroom\RocketShipitBundle\Model\ShipmentRequest;

class Package
{
    /**
     * @var string
     */
    private $trackingNumber;

    /**
     * @var string
     */
    private $labelFormat;

    /**
     * @var string
     */
    private $labelImage;

    /**
     * Package constructor.
     * @param string $trackingNumber
     * @param string $labelFormat
     * @param string $labelImage
     */
    public function __construct($trackingNumber, $labelFormat, $labelImage)
    {
        $this->trackingNumber = $trackingNumber;
        $this->labelFormat = $labelFormat;
        $this->labelImage = $labelImage;
    }

    /**
     * @return string
     */
    public function getTrackingNumber(): string
    {
        return $this->trackingNumber;
    }

    /**
     * @return string
     */
    public function getLabelFormat(): string
    {
        return $this->labelFormat;
    }

    /**
     * @return string
     */
    public function getLabelImage(): string
    {
        return $this->labelImage;
    }
}
