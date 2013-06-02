<?php

namespace Funddy\Bundle\JsCrossDomainBundle\Tests\UrlValidator;

use Funddy\Bundle\JsCrossDomainBundle\UrlValidator\ConfigurationUrlValidator;
use Mockery as m;

class ConfigurationUrlValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $validator;

    protected function setUp()
    {
        $this->validator = new ConfigurationUrlValidator($this->createContainerMock());
    }

    private function createContainerMock()
    {
        $containerMock = m::mock('Symfony\Component\DependencyInjection\ContainerInterface');
        $containerMock->shouldReceive('getParameter')->with('funddy.crossdomain.allowed')->andReturn(array(
            'http://funddy.com'
        ));
        return $containerMock;
    }

    /**
     * @test
     */
    public function allowedUrlShouldPass()
    {
        $this->validator->validate('http://funddy.com');
    }

    /**
     * @test
     * @expectedException Funddy\Bundle\JsCrossDomainBundle\UrlValidator\UrlNotAllowed
     */
    public function notAllowedUrlShouldThrowException()
    {
        $this->validator->validate('http://foo.com');
    }
}