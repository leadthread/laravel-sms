<?php

namespace Zenapply\Sms\Tests\Search;

use Zenapply\Sms\Search\Bandwidth as Search;
use Config;

class BandwidthTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'bandwidth';
    protected $defaultSearch = [];

    public function testSearchGivesAnArrayWithState()
    {
        $x = $this->getSearchInstance(["state" => "UT"]);
        var_dump($x->toArray());
        $this->assertEquals(["state" => "UT"], $x->toArray());
    }
}
