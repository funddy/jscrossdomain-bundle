<?php

namespace Funddy\Bundle\JsCrossDomainBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class FunddyJsCrossDomainExtension extends Extension
{
    private static $loadableFiles = array(
        'services.yml',
        'controllers.yml'
    );

    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        foreach (self::$loadableFiles as $loadableFile) {
            $loader->load($loadableFile);
        }

        $processor = new Processor();
        $configuration = new Configuration();
        $config = $processor->processConfiguration($configuration, $configs);

        $container->setParameter('funddy.crossdomain.allowed', $config['allowed']);
    }
}