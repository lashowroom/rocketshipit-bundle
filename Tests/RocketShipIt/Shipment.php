<?php

namespace RocketShipIt;

class Shipment extends GenericRocketShipitObject
{
    public $packages;

    public function addPackageToShipment($package)
    {
        $this->packages[] = $package;
    }

    public function submitShipment()
    {
        return [
            'charges' => 1.23,
            'negotiated_charges' => 1.02,
            'trk_main' => 'main_tracking_number',
            'pkgs' => [
                [
                    'pkg_trk_num' => 'track_1',
                    'label_fmt' => 'fmt_1',
                    'label_img' => 'image_1',
                ],
                [
                    'pkg_trk_num' => 'track_2',
                    'label_fmt' => 'fmt_2',
                    'label_img' => 'image_2',
                ]
            ]
        ];
    }
}
