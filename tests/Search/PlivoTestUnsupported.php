<?php

namespace LeadThread\Sms\Tests\Search;

use LeadThread\Sms\Search\Plivo as Search;
use Config;

class PlivoTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'plivo';
    protected $defaultSearch = ['type' => 'local', 'services' => 'sms', 'country_iso' => 'US'];
}
