<?php

namespace Funddy\Bundle\JsCrossDomainBundle\UrlValidator;

use Symfony\Component\DependencyInjection\ContainerInterface;

class ConfigurationUrlValidator implements UrlValidator
{
    private $allowedUrls;

    public function __construct(ContainerInterface $container)
    {
        $this->allowedUrls = $container->getParameter('funddy.crossdomain.allowed');
    }

    public function validate($url)
    {
        foreach ($this->allowedUrls as $allowedUrl) {
            if (strpos($url, $allowedUrl) === 0) {
                return;
            }
        }
        throw new UrlNotAllowed($url);
    }
}