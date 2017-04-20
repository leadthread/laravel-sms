<?php

namespace Leadthread\Sms\Tests\Drivers;

class TwilioTest extends TestCase
{
    protected $class = \Leadthread\Sms\Drivers\Twilio::class;
    protected $classArgs = ["user", "token"];
    protected $driver = 'twilio';
}
