<?php

namespace LeadThread\Sms\Tests\Search;

use LeadThread\Sms\Factories\SearchFactory;
use LeadThread\Sms\Tests\TestCase as BaseTestCase;
use Sms as SmsFacade;
use Config;

abstract class TestCase extends BaseTestCase
{
    protected $searchClass;
    protected $driver;

    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
        Config::set('sms.driver', $this->driver);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testItSuccessfullyReturnsTheCorrectSearchInstance()
    {
        $x = $this->getSearchInstance();
        $this->assertInstanceOf($this->searchClass, $x);
    }

    public function testSearchGivesAnArray()
    {
        $x = $this->getSearchInstance();
        $this->assertEquals($x->toArray(), $this->defaultSearch);
    }

    protected function getSearchInstance($options = [])
    {
        $d = config('sms.driver');
        $factory = new SearchFactory;
        return $factory->get($d, $options);
    }
}
