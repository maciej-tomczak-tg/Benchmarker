<?php

namespace BenchmarkerBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ReportDispatcherCompilerPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $dispatcherName = 'benchmarker.report.report_dispatcher';
        if (!$container->has($dispatcherName)) {
            return;
        }

        $definition = $container->findDefinition(
            $dispatcherName
        );

        $taggedServices = $container->findTaggedServiceIds(
            'benchmarker.report'
        );


        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'registerReporter',
                array(new Reference($id))
            );
        }
    }
}
