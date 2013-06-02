<?php

namespace Funddy\Bundle\JsCrossDomainBundle\UrlValidator;

class UrlNotAllowed extends \RuntimeException
{
    public function __construct($url)
    {
        parent::__construct(sprintf('Url "%s" not allowed', $url));
    }
}