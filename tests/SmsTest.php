<?php

namespace Zenapply\Sms\Tests;

use Zenapply\Sms\Exceptions\InvalidPhoneNumberException;
use Zenapply\Sms\Sms;

class SmsTest extends TestCase
{
    public function testItCreatesAnInstanceOfSms(){
        $sms = new Sms();
        $this->assertInstanceOf(Sms::class,$sms);
    }

    public function testItThrowsExceptionWhenUsingInvalidPhoneNumber(){
        $sms = new Sms();
        $this->setExpectedException(InvalidPhoneNumberException::class);
        $result = $sms->validatePhoneNumbers(["5552017374","asdf"],true);
    }
}
