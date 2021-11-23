<?php

namespace LeadThread\Sms\Tests\Responses;

use LeadThread\Sms\Tests\TestCase as BaseTestCase;
use Config;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
        Config::set('sms.driver', $this->driver);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testApplyResponse()
    {
        $x = new $this->class($this->getFakeResponse());
        $this->assertEquals("+13853008713", $x->number);
    }

    abstract protected function getFakeResponse();
}
