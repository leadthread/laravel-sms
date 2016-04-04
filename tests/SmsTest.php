<?php

namespace Zenapply\Sms\Tests;

use Zenapply\Sms\Sms;

class SmsTest extends TestCase
{
    public function testItCreatesAnInstanceOfSms(){
        $sms = new Sms();
        $this->assertInstanceOf(Sms::class,$sms);
    }
}
