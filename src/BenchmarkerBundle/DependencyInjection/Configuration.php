<?php

namespace BenchmarkerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('benchmarker');
        $rootNode
            ->children()
            ->scalarNode('log_file_name')->end()
            ->arrayNode('report')
            ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('ratio')->end()
                        ->scalarNode('phone')->end()
                        ->scalarNode('address')->end()
                        ->scalarNode('email_template')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ->end();

        return $treeBuilder;
    }

}
