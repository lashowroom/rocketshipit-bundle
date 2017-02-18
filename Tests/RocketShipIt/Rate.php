<?php

namespace RocketShipIt;

class Rate extends GenericRocketShipitObject
{
    public $packages;

    public function addPackageToShipment(Package $package)
    {
        $this->packages[] = $package;
    }
}
