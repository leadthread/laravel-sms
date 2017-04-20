<?php

namespace LeadThread\Sms\Tests\Search;

use LeadThread\Sms\Search\Log as Search;
use Config;

class LogTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'log';
    protected $defaultSearch = [];
}
