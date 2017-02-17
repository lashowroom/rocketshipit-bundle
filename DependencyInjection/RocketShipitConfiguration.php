<?php

namespace LAShowroom\RocketShipitBundle\DependencyInjection;

use RocketShipIt\Config;

class RocketShipitConfiguration
{
    private $configuration;

    /**
     * @param array $configValues
     */
    public function __construct(array $configValues)
    {
        $this->configuration = new Config();

        foreach ($configValues as $section => $settings) {
            foreach ($settings as $param => $value) {
                $this->configuration->setDefault($section, $param, $value);
            }
        }
    }

    public function getConfiguration()
    {
        return ['config' => $this->configuration];
    }
}
