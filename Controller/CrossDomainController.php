<?php

namespace Funddy\Bundle\JsCrossDomainBundle\Controller;

use Funddy\Bundle\JsCrossDomainBundle\CrossDomainBrowser\CrossDomainBrowser;
use Funddy\Bundle\JsCrossDomainBundle\HttpClient\CannotOpenUrl;
use Funddy\Bundle\JsCrossDomainBundle\UrlValidator\UrlNotAllowed;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CrossDomainController
{
    private $browser;

    public function __construct(CrossDomainBrowser $browser)
    {
        $this->browser = $browser;
    }

    public function requestAction(Request $request)
    {
        if (!$request->query->has('url')) {
            throw new NotFoundHttpException();
        }

        $url = urldecode($request->query->get('url'));

        try {
            $response = $this->browser->get($url);
        } catch (UrlNotAllowed $e) {
            throw new NotFoundHttpException();
        } catch (CannotOpenUrl $e) {
            throw new NotFoundHttpException();
        }

        return new Response($response);
    }
}