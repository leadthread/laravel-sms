<?php

namespace Zenapply\Sms\Tests\Search;

use Zenapply\Sms\Search\Log as Search;
use Config;

class LogTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'log';
    protected $defaultSearch = [];
}
