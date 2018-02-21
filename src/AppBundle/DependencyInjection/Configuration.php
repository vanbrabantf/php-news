<?php

namespace App\AppBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('app');

        $rootNode
            ->children()
                ->arrayNode('feeds')
                    ->children()
                        ->scalarNode('id')->isRequired()->end()
                        ->scalarNode('feedUrl')->isRequired()->end()
                        ->scalarNode('name')->isRequired()->end()
                        ->scalarNode('author')->isRequired()->end()
                        ->scalarNode('twitter')->end()
                        ->scalarNode('facebook')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
