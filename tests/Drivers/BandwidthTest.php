<?php

namespace Leadthread\Sms\Tests\Drivers;

class BandwidthTest extends TestCase
{
    protected $class = \Leadthread\Sms\Drivers\Bandwidth::class;
    protected $classArgs = ["user", "token", "secret"];
    protected $driver = 'bandwidth';
}
