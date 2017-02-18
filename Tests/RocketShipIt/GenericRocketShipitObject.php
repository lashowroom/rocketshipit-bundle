<?php

namespace RocketShipIt;

class GenericRocketShipitObject
{
    public $carrier;
    public $configuration;
    public $parameters = [];

    /**
     * @param $carrier
     * @param $configuration
     */
    public function __construct($carrier, $configuration)
    {
        $this->carrier = $carrier;
        $this->configuration = $configuration;
    }

    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }
}
