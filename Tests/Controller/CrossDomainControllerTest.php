<?php

namespace Funddy\Bundle\JsCrossDomainBundle\Tests\UrlValidator;

use Funddy\Bundle\JsCrossDomainBundle\Controller\CrossDomainController;
use Mockery as m;

class CrossDomainControllerTest extends \PHPUnit_Framework_TestCase
{
    private $browserMock;
    private $requestMock;
    private $controller;

    protected function setUp()
    {
        $this->browserMock = m::mock('Funddy\Bundle\JsCrossDomainBundle\CrossDomainBrowser\CrossDomainBrowser');
        $this->controller = new CrossDomainController($this->browserMock);
        $this->requestMock = m::mock('Symfony\Component\HttpFoundation\Request');
        $this->requestMock->query = m::mock('Symfony\Component\HttpFoundation\ParameterBag');
    }


    /**
     * @test
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function noUrlParameterShouldThrowException()
    {
        $this->requestQueryShouldHaveUrlParameter(false);

        $this->controller->requestAction($this->requestMock);
    }

    private function requestQueryShouldHaveUrlParameter($have)
    {
        $this->requestMock->query->shouldReceive('has')->with('url')->once()->andReturn($have);
    }

    /**
     * @test
     */
    public function shouldGetUrl()
    {
        $this->requestQueryShouldHaveUrlParameter(true);
        $this->requestMock->query->shouldReceive('get')->with('url')->once()->andReturn('http%3A%2F%2Ffunddy.com%3Ftest%3Dfoo');
        $this->browserMock->shouldReceive('get')->with('http://funddy.com?test=foo')->once()->andReturn('content');

        $response = $this->controller->requestAction($this->requestMock);

        $this->assertThat($response->getContent(), $this->identicalTo('content'));
    }

    /**
     * @test
     * @dataProvider errorExceptions
     * @expectedException Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function errorShouldThrowException($exception)
    {
        $this->requestQueryShouldHaveUrlParameter(true);
        $this->requestMock->query->shouldReceive('get')->with('url')->once()->andReturn('http%3A%2F%2Ffunddy.com%3Ftest%3Dfoo');
        $this->browserMock->shouldReceive('get')->with('http://funddy.com?test=foo')->once()->andThrow($exception);

        $this->controller->requestAction($this->requestMock);
    }

    public function errorExceptions()
    {
        return array(
            array('Funddy\Bundle\JsCrossDomainBundle\UrlValidator\UrlNotAllowed'),
            array('Funddy\Bundle\JsCrossDomainBundle\HttpClient\CannotOpenUrl')
        );
    }
}