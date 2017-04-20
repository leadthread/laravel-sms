<?php

namespace Leadthread\Sms\Tests\Search;

use Leadthread\Sms\Search\Twilio as Search;
use Config;

class TwilioTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'twilio';
    protected $defaultSearch = ["Sms" => true];
}
