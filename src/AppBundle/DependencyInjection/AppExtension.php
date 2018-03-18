<?php

namespace App\AppBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class AppExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('feeds', $config['feeds']);
        $container->setParameter('integration_twitter_consumer_key', $config['twitter']['consumerKey']);
        $container->setParameter('integration_twitter_consumer_secret', $config['twitter']['consumerSecret']);
        $container->setParameter('integration_twitter_oauth_token', $config['twitter']['oauthToken']);
        $container->setParameter('integration_twitter_oauth_secret', $config['twitter']['oauthSecret']);
    }
}
