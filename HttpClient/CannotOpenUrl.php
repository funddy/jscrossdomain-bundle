<?php

namespace Funddy\Bundle\JsCrossDomainBundle\HttpClient;

class CannotOpenUrl extends \RuntimeException
{
    public function __construct($url)
    {
        parent::__construct(sprintf('Cannot open url "%s"', $url));
    }
}
