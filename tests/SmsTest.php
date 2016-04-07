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

    public function testItThrowsExceptionWhenUsingInvalidPhoneNumber(){
        $sms = new Sms();
        $this->setExpectedException(InvalidPhoneNumberException::class);
        $result = $sms->validatePhoneNumbers(["5552017374","asdf"],true);
    }
}
