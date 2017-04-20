<?php

namespace Leadthread\Sms\Tests\Responses;

use Leadthread\Sms\Tests\TestCase as BaseTestCase;
use Config;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        Config::set('sms.driver', $this->driver);
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function testApplyResponse()
    {
        $x = new $this->class($this->getFakeResponse());
        $this->assertEquals("+18887776666", $x->number);
    }

    abstract protected function getFakeResponse();
}
