<?php

namespace LAShowroom\RocketShipitBundle\Tests\Model\Carrier;

use LAShowroom\RocketShipitBundle\Model\Carrier\Ups;

class UpsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $serviceCode
     * @param $serviceDescription
     * @dataProvider serviceDescriptionMap
     */
    public function testGetServiceDescription($serviceCode, $serviceDescription)
    {
        $this->assertEquals($serviceDescription, (new Ups())->getServiceDescription($serviceCode));
    }

    public function serviceDescriptionMap()
    {
        return [
            ['01', 'UPS Next Day Air'],
            ['02', 'UPS 2nd Day Air'],
            ['03', 'UPS Ground'],
            ['07', 'UPS Worldwide Express'],
            ['08', 'UPS Worldwide Expedited'],
            ['11', 'UPS Standard'],
            ['12', 'UPS 3 Day Select'],
            ['13', 'UPS Next Day Air Saver'],
            ['14', 'UPS Next Day Air Early AM'],
            ['54', 'UPS Worldwide Express Plus'],
            ['59', 'UPS Second Day Air AM'],
            ['65', 'UPS Worldwide Saver'],
            ['M2', 'UPS First-Class Mail'],
            ['M3', 'UPS Priority Mail'],
            ['M4', 'UPS Expedited Mail Innovations'],
            ['M5', 'UPS Priority Mail Innovations'],
            ['M6', 'UPS Economy Mail Innovations'],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Invalid UPS service code: doge
     */
    public function testInvalidShipCode()
    {
        (new Ups())->getServiceDescription('doge');
    }
}
