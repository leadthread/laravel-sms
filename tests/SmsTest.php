<?php

namespace LeadThread\Sms\Tests;

use LeadThread\Sms\Sms;
use Sms as SmsFacade;

class SmsTest extends TestCase
{
    public function testItCreatesAnInstanceOfSms()
    {
        $sms = new Sms();
        $this->assertInstanceOf(Sms::class, $sms);
    }

    public function testTheFacade()
    {
        $sms = SmsFacade::getFacadeRoot();
        $this->assertInstanceOf(Sms::class, $sms);
    }
}
