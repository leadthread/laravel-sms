<?php

namespace LeadThread\Sms\Tests\Drivers;

use LeadThread\Sms\Sms;

class BandwidthTest extends TestCase
{
    protected $class = \LeadThread\Sms\Drivers\Bandwidth::class;
    protected $classArgs = [[
        'messagingBasicAuthUserName' => null,
        'messagingBasicAuthPassword' => null,
    ], "account", "application"];
    protected $driver = 'bandwidth';

    protected function getSmsInstanceWithMockedDriver()
    {
        $mock = $this->getMock($this->class, ['send'], $this->classArgs);
        
        $mock->expects($this->any())
             ->method('send');

        return new Sms($mock);
    }
}
