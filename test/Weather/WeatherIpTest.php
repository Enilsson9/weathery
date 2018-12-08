<?php

namespace Edward\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleJsonController.
 */
class WeatherIpTest extends TestCase
{

    // Create the di container.
    protected $di;
    protected $controller;



    /**
     * Just assert something is true.
     */
    public function testValidateIp()
    {
        $object = new WeatherIp();
        $ipAddress = "186.151.62.176";
        $res = $object->validateIp($ipAddress);
        $exp = "186.151.62.176";

        $this->assertEquals($exp, $res);
    }

    /**
     * Just assert something is true.
     */
    public function testValidateIpFalse()
    {
        $object = new WeatherIp();
        $ipAddress = "1234";
        $res = $object->validateIp($ipAddress);
        $exp = null;

        $this->assertEquals($exp, $res);
    }
}
