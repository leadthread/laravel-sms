<?php

namespace LeadThread\Sms\Tests\Drivers;

use LeadThread\Sms\Sms;

class BandwidthTest extends TestCase
{
    protected $class = \LeadThread\Sms\Drivers\Bandwidth::class;
    protected $classArgs = [[
        'messagingBasicAuthUserName' => "78e808d0936b1bc481186b85a7157e6ade7ff5afbcf6dec8",
        'messagingBasicAuthPassword' => "4fdbd46cf8eccbb9529f3d51a415cd902313857b625a7dab",
    ], "5008099", "4ec988e7-f6d1-4918-800e-4b3f8204ae1a"];
    protected $driver = 'bandwidth';

    protected function getSmsInstanceWithMockedDriver()
    {
        return new Sms(new \LeadThread\Sms\Drivers\Bandwidth($this->classArgs[0], $this->classArgs[1], $this->classArgs[2]));
        // $mock = $this->getMock($this->class, ['send'], $this->classArgs);
        
        // $mock->expects($this->any())
        //      ->method('send');

        // return new Sms($mock);
    }
}
