<?php

namespace Zenapply\Sms\Tests\Sms;

use Config;

class TwilioTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        Config::set('sms.driver', 'twilio');
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
