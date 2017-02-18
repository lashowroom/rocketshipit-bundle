<?php

namespace RocketShipIt;

class Shipment extends GenericRocketShipitObject
{
    public $packages;

    public function addPackageToShipment($package)
    {
        $this->packages[] = $package;
    }
}
