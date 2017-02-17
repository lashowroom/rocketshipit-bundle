<?php

namespace LAShowroom\RocketShipitBundle\Model\Carrier;

abstract class Carrier
{
    /**
     * @return string
     */
    abstract public function __toString();

    /**
     * @param string $serviceCode
     * @return string
     */
    abstract public function getServiceDescription($serviceCode);
}
