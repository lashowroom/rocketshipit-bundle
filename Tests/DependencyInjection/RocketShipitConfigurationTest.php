<?php

namespace LAShowroom\RocketShipitBundle\Tests\DependencyInjection;

use LAShowroom\RocketShipitBundle\DependencyInjection\RocketShipitConfiguration;

class RocketShipitConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyConfiguration()
    {
        $configuration = new RocketShipitConfiguration([]);

        $this->assertEquals(['config' => new \RocketShipit\Config()], $configuration->getConfiguration());
    }

    public function testValuesSet()
    {
        $configuration = new RocketShipitConfiguration($expected = [
            'section1' => [
                'key1' => 'value1',
                'key2' => 'value2',
            ],
            'section2' => [
                'key3' => 'value3',
                'key4' => 'value4',
            ],
        ]);

        $this->assertEquals($expected, $configuration->getConfiguration()['config']->parameters);

        $configuration->getConfiguration();
    }
}
