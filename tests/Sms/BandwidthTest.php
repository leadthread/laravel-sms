<?php

namespace Zenapply\Sms\Tests\Sms;

use Config;

class BandwidthTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        Config::set('sms.driver', 'bandwidth');
    }

    public function tearDown()
    {
        parent::tearDown();
    }
}
