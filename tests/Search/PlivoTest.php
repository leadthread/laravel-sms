<?php

namespace Leadthread\Sms\Tests\Search;

use Leadthread\Sms\Search\Plivo as Search;
use Config;

class PlivoTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'plivo';
    protected $defaultSearch = ['type' => 'local', 'services' => 'sms', 'country_iso' => 'US'];
}
