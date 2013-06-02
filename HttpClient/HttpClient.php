<?php

namespace Funddy\Bundle\JsCrossDomainBundle\HttpClient;

interface HttpClient
{
    public function get($url);
}