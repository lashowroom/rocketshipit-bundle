<?php

namespace LAShowroom\RocketShipitBundle\Tests\DependencyInjection;

use LAShowroom\RocketShipitBundle\DependencyInjection\LAShowroomRocketShipitExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LAShowroomRocketShipitExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LAShowroomRocketShipitExtension
     */
    private $extension;

    /**
     * Root name of the configuration
     *
     * @var string
     */
    private $root;

    public function setUp()
    {
        parent::setUp();

        $this->extension = $this->getExtension();
        $this->root = "la_showroom_rocket_shipit";
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     * @expectedExceptionMessage The child node "generic" at path "la_showroom_rocket_shipit" must be configured
     */
    public function testTimezoneRequired()
    {
        $this->extension->load(['la_showroom_rocket_shipit' => []], $container = $this->getContainer());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     * @expectedExceptionMessage The child node "generic" at path "la_showroom_rocket_shipit" must be configured
     */
    public function testConfigurationRequired()
    {
        $this->extension->load([], $container = $this->getContainer());

    }

    public function testMinimalConfiguration()
    {
        $this->extension->load(['la_showroom_rocket_shipit' => ['generic' => ['timezone' => 'America/Los_Angeles', ]]], $container = $this->getContainer());
    }

    /**
     * @expectedException \Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     * @expectedExceptionMessage Invalid configuration for path "la_showroom_rocket_shipit.generic.timezone": Invalid timezone: "doge\/wow"
     */
    public function testTimezoneValidation()
    {
        $this->extension->load(['la_showroom_rocket_shipit' => ['generic' => ['timezone' => 'doge/wow', ]]], $container = $this->getContainer());
    }

    /**
     * @return LAShowroomRocketShipitExtension
     */
    protected function getExtension()
    {
        return new LAShowroomRocketShipitExtension();
    }

    /**
     * @return ContainerBuilder
     */
    private function getContainer()
    {
        $container = new ContainerBuilder();

        return $container;
    }
}
