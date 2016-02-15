<?php

namespace BenchmarkerBundle;

use BenchmarkerBundle\DependencyInjection\ReportDispatcherCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BenchmarkerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ReportDispatcherCompilerPass());
    }
}
