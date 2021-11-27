<?php

namespace LeadThread\Sms\Tests\Search;

use LeadThread\Sms\Search\Twilio as Search;
use Config;

class TwilioTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'twilio';
    protected $defaultSearch = ["Sms" => true];
}
