<?php

namespace Funddy\Bundle\JsCrossDomainBundle\HttpClient;

class FileGetContentsHttpClient implements HttpClient
{
    public function get($url)
    {
        if (($content = @file_get_contents($url)) === false) {
            throw new CannotOpenUrl($url);
        }
        return $content;
    }
}