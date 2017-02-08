<?php

namespace Zenapply\Sms\Tests\Drivers;

class BandwidthTest extends TestCase
{
    protected $class = \Zenapply\Sms\Drivers\Bandwidth::class;
    protected $classArgs = ["user", "token", "secret"];
    protected $driver = 'bandwidth';
}
