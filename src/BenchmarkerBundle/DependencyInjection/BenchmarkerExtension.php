<?php

namespace BenchmarkerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class BenchmarkerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');


        $container->setParameter(
            'benchmarker.log_file_name',
            $container->getParameter('kernel.logs_dir') . '/' .$config['log_file_name']
        );

        $container->setParameter('benchmarker.sms_reporter.ratio', $config['report']['sms_reporter']['ratio']);
        $container->setParameter('benchmarker.sms_reporter.phone', $config['report']['sms_reporter']['phone']);

        $container->setParameter('benchmarker.email_reporter.address', $config['report']['email_reporter']['address']);
        $container->setParameter(
            'benchmarker.email_reporter.email_template',
            $config['report']['email_reporter']['email_template']
        );
        $container->setParameter('benchmarker.email_reporter.ratio', $config['report']['email_reporter']['ratio']);


    }
}
