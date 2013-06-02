<?php

namespace Funddy\Bundle\JsCrossDomainBundle\Tests\UrlValidator;

use Funddy\Bundle\JsCrossDomainBundle\CrossDomainBrowser\CrossDomainBrowser;
use Mockery as m;

class CrossDomainBrowserTest extends \PHPUnit_Framework_TestCase
{
    private $urlValidatorMock;
    private $httpClientMock;
    private $browser;

    protected function setUp()
    {
        $this->urlValidatorMock = m::mock('Funddy\Bundle\JsCrossDomainBundle\UrlValidator\UrlValidator');
        $this->httpClientMock = m::mock('Funddy\Bundle\JsCrossDomainBundle\HttpClient\HttpClient');
        $this->browser = new CrossDomainBrowser($this->urlValidatorMock, $this->httpClientMock);
    }

    /**
     * @test
     */
    public function shouldValidateBeforeGet()
    {
        $this->urlValidatorMock->shouldReceive('validate')->with('url')->once();
        $this->httpClientMock->shouldReceive('get')->with('url')->once()->andReturn('content');

        $response = $this->browser->get('url');

        $this->assertThat($response, $this->identicalTo('content'));
    }
}