<?php

namespace Zenapply\Sms\Tests\Search;

use Zenapply\Sms\Search\Bandwidth as Search;
use Config;

class BandwidthTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'bandwidth';
    protected $defaultSearch = [];
}
