<?php

namespace Funddy\Bundle\JsCrossDomainBundle\UrlValidator;

interface UrlValidator
{
    public function validate($url);
}