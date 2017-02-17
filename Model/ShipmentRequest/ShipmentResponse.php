<?php

namespace LAShowroom\RocketShipitBundle\Model\ShipmentRequest;

use Money\Currency;
use Money\Money;

class ShipmentResponse
{
    /**
     * @var Money
     */
    private $charges;

    /**
     * @var Money
     */
    private $negotiatedCharges;

    /**
     * @var string
     */
    private $mainTrackingNumber;

    /**
     * @var
     */
    private $packages;

    /**
     * @var ShipmentRequest
     */
    private $shipmentRequest;

    /**
     * @param ShipmentRequest $shipmentRequest
     */
    public function __construct(ShipmentRequest $shipmentRequest, array $response)
    {
        $this->shipmentRequest = $shipmentRequest;

        $this->charges = new Money((int) ($response['charges'] * 100), new Currency('USD'));

        if ($shipmentRequest->isNegotiatedRates() && !empty($response['negotiated_charges'])) {
            $this->negotiatedCharges = new Money((int) ($response['negotiated_charges'] * 100), new Currency('USD'));
        }

        $this->mainTrackingNumber = $response['trk_main'];

        foreach ($response['pkgs'] as $pkg) {
            $this->packages[] = new Package($pkg['pkg_trk_num'], $pkg['label_fmt'], $pkg['label_img']);
        }
    }
}
