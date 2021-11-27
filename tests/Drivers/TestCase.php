<?php

namespace LeadThread\Sms\Tests\Drivers;

use LeadThread\Sms\Exceptions\InvalidPhoneNumberException;
use LeadThread\Sms\Sms;
use LeadThread\Sms\Interfaces\SendsSms;
use LeadThread\Sms\Factories\DriverFactory;
use LeadThread\Sms\Tests\TestCase as BaseTestCase;
use Sms as SmsFacade;
use Config;

abstract class TestCase extends BaseTestCase
{
    protected $driver;
    protected $class;
    protected $classArgs;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
        Config::set('sms.driver', $this->driver);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testItSuccessfullyCreatesAllDrivers()
    {
        $d = config('sms.driver');
        $factory = new DriverFactory;
        $driver = $factory->get($d);
        $this->assertInstanceOf(SendsSms::class, $driver);
    }

    public function testAllNumbers()
    {
        $sms = $this->getSmsInstanceWithMockedDriver($this->getMockReturns('testAllNumbers'));
        $result = $sms->allNumbers();
        $this->assertTrue(is_array($result->numbers));
    }

    public function testSmsSend()
    {
        $sms = $this->getSmsInstanceWithMockedDriver($this->getMockReturns('testSmsSend'));
        $result = $sms->send("message", "+13852017374", "+13853008713");
        $this->assertEquals('+13853008713', $result->number);
    }

    public function testSmsSendMany()
    {
        $sms = $this->getSmsInstanceWithMockedDriver($this->getMockReturns('testSmsSendMany'));
        $result = $sms->sendMany("message 4", ["+13852017374", "+13852017374"], "+13853008713");
        $this->assertTrue(is_array($result->numbers));
        $this->assertEquals('+13853008713', $result->number);
    }

    public function testSmsSendArray()
    {
        $sms = $this->getSmsInstanceWithMockedDriver($this->getMockReturns('testSmsSendArray'));
        $result = $sms->sendArray([
            ["msg"=>"message 1", "to"=>"+13852017374", "from"=>"+13853008713"],
            ["msg"=>"message 2", "to"=>"+13852017374", "from"=>"+13854490011"],
            ["msg"=>"message 3", "to"=>"+13852017374", "from"=>"+13853008713"],
        ]);

        $this->assertTrue(is_array($result->numbers));
        $this->assertTrue(in_array('+13853008713', $result->numbers));
        // $this->assertTrue(in_array('+13854490011', $result->numbers));
    }

    protected function getSmsInstanceWithMockedDriver()
    {
        $mock = $this->getMock($this->class, ['send'], $this->classArgs);
        
        $mock->expects($this->any())
             ->method('send');

        return new Sms($mock);
    }
}
