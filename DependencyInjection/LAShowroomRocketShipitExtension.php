<?php

namespace LAShowroom\RocketShipitBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class LAShowroomRocketShipitExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('rocket-shipit_configuration', $config);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        if (!empty($config['cache'])) {
            $container
                ->getDefinition('la_showroom_rocket_shipit.manager')
                ->addMethodCall('setCacheItemPool', [
                    new Reference($config['cache'])
                ])
            ;

            unset($config['cache']);
        }
    }
}
