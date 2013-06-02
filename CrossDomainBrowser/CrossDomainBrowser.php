<?php

namespace Funddy\Bundle\JsCrossDomainBundle\CrossDomainBrowser;

use Funddy\Bundle\JsCrossDomainBundle\HttpClient\HttpClient;
use Funddy\Bundle\JsCrossDomainBundle\UrlValidator\UrlValidator;

class CrossDomainBrowser
{
    private $urlValidator;
    private $httpClient;

    public function __construct(UrlValidator $urlValidator, HttpClient $httpClient)
    {
        $this->urlValidator = $urlValidator;
        $this->httpClient = $httpClient;
    }

    public function get($url)
    {
        $this->urlValidator->validate($url);
        return $this->httpClient->get($url);
    }
}