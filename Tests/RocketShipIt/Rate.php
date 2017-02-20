<?php

namespace RocketShipIt;

class Rate extends GenericRocketShipitObject
{
    public $packages;

    public function addPackageToShipment(Package $package)
    {
        $this->packages[] = $package;
    }

    public function getAllRates()
    {
        return [
            'RatingServiceSelectionResponse' => [
                'Response' => [
                    'ResponseStatusDescription' => 'Success'
                ],
                'RatedShipment' => [
                    [
                        'Service' => [
                            'Code' => '03',
                        ],
                        'TransportationCharges' => [
                            'MonetaryValue' => 1.23,
                            'CurrencyCode' => 'USD',
                        ],
                        'ServiceOptionsCharges' => [
                            'MonetaryValue' => 1.45,
                            'CurrencyCode' => 'USD',
                        ],
                        'TotalCharges' => [
                            'MonetaryValue' => 1.56,
                            'CurrencyCode' => 'USD',
                        ],
                        'NegotiatedRates' => [
                            'NetSummaryCharges' => [
                                'GrandTotal' => [
                                    'MonetaryValue' => 1.67,
                                    'CurrencyCode' => 'USD',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }
}
