<?php

namespace LAShowroom\RocketShipitBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('la_showroom_rocket_shipit');
        $rootNode->cannotBeEmpty();

        $rootNode
            ->children()
                ->scalarNode('cache')
                    ->info('A PSR-6 compatible cache')
                ->end()
                ->arrayNode('generic')
                    ->isRequired()
                    ->children()
                        ->booleanNode('debug')
                            ->defaultTrue()
                            ->info('Whether to enable production or testmode')
                        ->end()
                        ->scalarNode('timezone')
                            ->info('The timezone to use')
                            ->isRequired()
                            ->validate()
                            ->ifNotInArray(timezone_identifiers_list())
                                ->thenInvalid('Invalid timezone: %s')
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('ups')
                    ->children()
                        ->scalarNode('license')
                            ->isRequired()
                        ->end()
                        ->scalarNode('username')
                            ->isRequired()
                        ->end()
                        ->scalarNode('password')
                            ->isRequired()
                        ->end()
                        ->scalarNode('accountNumber')
                            ->isRequired()
                        ->end()
                        ->scalarNode('labelPrintMethodCode')
                            ->defaultValue('GIF')
                        ->end()
                        ->scalarNode('labelImageFormat')
                            ->defaultValue('GIF')
                        ->end()
                        ->scalarNode('httpUserAgent')
                            ->defaultValue('Mozilla/4.5')
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
