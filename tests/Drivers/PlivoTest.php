<?php

namespace Leadthread\Sms\Tests\Drivers;

class PlivoTest extends TestCase
{
    protected $class = \Leadthread\Sms\Drivers\Plivo::class;
    protected $classArgs = ["user", "token"];
    protected $driver = 'plivo';
}
