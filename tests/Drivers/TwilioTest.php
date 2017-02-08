<?php

namespace Zenapply\Sms\Tests\Drivers;

class TwilioTest extends TestCase
{
    protected $class = \Zenapply\Sms\Drivers\Twilio::class;
    protected $classArgs = ["user", "token"];
    protected $driver = 'twilio';
}
