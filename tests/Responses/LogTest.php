<?php

namespace Zenapply\Sms\Tests\Responses;

class LogTest extends TestCase
{
    protected $class = \Zenapply\Sms\Responses\Log::class;
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
