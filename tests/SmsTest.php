<?php

namespace Zenapply\Sms\Tests;

use Zenapply\Sms\Exceptions\InvalidPhoneNumberException;
use Zenapply\Sms\Sms;
use Zenapply\Sms\Drivers\SendsSms;
use Zenapply\Sms\Factories\DriverFactory;

class SmsTest extends TestCase
{
    public function testItCreatesAnInstanceOfSms(){
        $sms = new Sms();
        $this->assertInstanceOf(Sms::class,$sms);
    }

    public function testItSuccessfullyCreatesAllDrivers(){
        $drivers = ['twilio','plivo'];
        $factory = new DriverFactory;
        foreach ($drivers as $d) {
            $driver = $factory->get($d);
            $this->assertInstanceOf(SendsSms::class,$driver);
        }
    }

    public function testItThrowsExceptionWhenUsingInvalidPhoneNumberArray(){
        $sms = new Sms();
        $this->setExpectedException(InvalidPhoneNumberException::class);
        $result = $sms->validatePhoneNumbers(["(734) 555 1212","asdf"],true);
    }

    public function testItThrowsExceptionWhenUsingInvalidPhoneNumber(){
        $sms = new Sms();
        $this->setExpectedException(InvalidPhoneNumberException::class);
        $result = $sms->validatePhoneNumber("asdf",true);
    }

    public function testItPassesAValidPhoneNumber(){
        $sms = new Sms();
        $result = $sms->validatePhoneNumber("(734) 555 1212",true);
    }

    public function testSmsSend(){
        $sms = $this->getSmsInstanceWithMockedDriver();
        $sms->send("message","(734) 555 1211","(734) 555 1212");
    }

    public function testSmsSendMany(){
        $sms = $this->getSmsInstanceWithMockedDriver();
        $sms->sendMany("message",["(734) 555 1213","(734) 555 1214"],"(734) 555 1215");
    }

    public function testSmsSendArray(){
        $sms = $this->getSmsInstanceWithMockedDriver();
        $sms->sendArray([
            ["msg"=>"message","to"=>"(734) 555 1214","from"=>"(734) 555 1215"],
            ["msg"=>"message","to"=>"(734) 555 1213","from"=>"(734) 555 1216"],
            ["msg"=>"message","to"=>"(734) 555 1212","from"=>"(734) 555 1217"],
        ]);
    }

    protected function getSmsInstanceWithMockedDriver(){
        $mock = $this->getMock('Zenapply\Sms\Drivers\Plivo\Request', ['send'], ['user','token']);
        
        $mock->expects($this->any())
             ->method('send');

        return new Sms($mock);
    }
}
