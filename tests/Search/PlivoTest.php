<?php

namespace Zenapply\Sms\Tests\Search;

use Zenapply\Sms\Search\Plivo as Search;
use Config;

class PlivoTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'plivo';
    protected $defaultSearch = ['type' => 'local', 'services' => 'sms'];
}
