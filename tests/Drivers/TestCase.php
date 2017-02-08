<?php

namespace Zenapply\Sms\Tests\Drivers;

use Zenapply\Sms\Exceptions\InvalidPhoneNumberException;
use Zenapply\Sms\Sms;
use Zenapply\Sms\Interfaces\SendsSms;
use Zenapply\Sms\Factories\DriverFactory;
use Zenapply\Sms\Tests\TestCase as BaseTestCase;
use Sms as SmsFacade;
use Config;

abstract class TestCase extends BaseTestCase
{
    protected $driver;

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        Config::set('sms.driver', $this->driver);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testItCreatesAnInstanceOfSms()
    {
        $sms = new Sms();
        $this->assertInstanceOf(Sms::class, $sms);
    }

    public function testItSuccessfullyCreatesAllDrivers()
    {
        $d = config('sms.driver');
        $factory = new DriverFactory;
        $driver = $factory->get($d);
        $this->assertInstanceOf(SendsSms::class, $driver);
    }

    public function testSmsSend()
    {
        $sms = $this->getSmsInstanceWithMockedDriver();
        $sms->send("message", "(734) 555 1211", "(734) 555 1212");
    }

    public function testSmsSendMany()
    {
        $sms = $this->getSmsInstanceWithMockedDriver();
        $sms->sendMany("message", ["(734) 555 1213", "(734) 555 1214"], "(734) 555 1215");
    }

    public function testSmsSendArray()
    {
        $sms = $this->getSmsInstanceWithMockedDriver();
        $sms->sendArray([
            ["msg"=>"message", "to"=>"(734) 555 1214", "from"=>"(734) 555 1215"],
            ["msg"=>"message", "to"=>"(734) 555 1213", "from"=>"(734) 555 1216"],
            ["msg"=>"message", "to"=>"(734) 555 1212", "from"=>"(734) 555 1217"],
        ]);
    }

    protected function getSmsInstanceWithMockedDriver()
    {
        $mock = $this->getMock($this->class, ['send'], $this->classArgs);
        
        $mock->expects($this->any())
             ->method('send');

        return new Sms($mock);
    }
}
