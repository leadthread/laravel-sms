<?php

namespace LeadThread\Sms\Tests\Drivers;

class BandwidthTest extends TestCase
{
    protected $class = \LeadThread\Sms\Drivers\Bandwidth::class;
    protected $classArgs = ["user", "token", "secret"];
    protected $driver = 'bandwidth';
}
