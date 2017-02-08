<?php

namespace Zenapply\Sms\Tests\Drivers;

class PlivoTest extends TestCase
{
    protected $class = \Zenapply\Sms\Drivers\Plivo::class;
    protected $classArgs = ["user", "token"];
    protected $driver = 'plivo';
}
