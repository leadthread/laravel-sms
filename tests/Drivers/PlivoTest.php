<?php

namespace LeadThread\Sms\Tests\Drivers;

class PlivoTest extends TestCase
{
    protected $class = \LeadThread\Sms\Drivers\Plivo::class;
    protected $classArgs = ["user", "token"];
    protected $driver = 'plivo';
}
