<?php

namespace LeadThread\Sms\Tests\Drivers;

class TwilioTest extends TestCase
{
    protected $class = \LeadThread\Sms\Drivers\Twilio::class;
    protected $classArgs = ["user", "token"];
    protected $driver = 'twilio';
}
