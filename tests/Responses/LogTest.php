<?php

namespace LeadThread\Sms\Tests\Responses;

class LogTest extends TestCase
{
    protected $class = \LeadThread\Sms\Responses\Log::class;
    protected $driver = 'log';

    protected function getFakeResponse()
    {
        return [];
    }

    public function testApplyResponse()
    {
        $x = new $this->class($this->getFakeResponse());
        $this->assertEquals(null, $x->number);
    }
}
