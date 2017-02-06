<?php

namespace Zenapply\Sms\Tests\Sms;

use Config;

class PlivoTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        Config::set('sms.driver', 'plivo');
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
