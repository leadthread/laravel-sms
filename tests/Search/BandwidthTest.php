<?php

namespace Leadthread\Sms\Tests\Search;

use Leadthread\Sms\Search\Bandwidth as Search;
use Config;

class BandwidthTest extends TestCase
{
    protected $searchClass = Search::class;
    protected $driver = 'bandwidth';
    protected $defaultSearch = [];

    public function testSearchGivesAnArrayWithState()
    {
        $x = $this->getSearchInstance(["state" => "UT"]);
        $this->assertEquals(["state" => "UT"], $x->toArray());
    }
}
