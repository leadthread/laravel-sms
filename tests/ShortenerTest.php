<?php

namespace Zenapply\Shortener\Tests;

use Zenapply\Shortener\Shortener;
use Zenapply\Shortener\Exceptions\ShortenerException;
use Zenapply\Shortener\Drivers\Bitly as BitlyDriver;
use Zenapply\Bitly\Bitly;

class ShortenerTest extends TestCase
{
    public function testItCreatesAnInstanceOfShortener(){
        $shortener = new Shortener();
        $this->assertInstanceOf(Shortener::class,$shortener);
    }

    public function testShortenMethodReturnsValue(){
        $shortener = $this->getShortenerWithMockedDriver("http://bar.com/");
        $url = $shortener->shorten("https://foo.bar");
        $this->assertEquals($url,"http://bar.com/");
    }

    public function testThrowsExceptionWhenUsingUnsupportedDriver(){
        $this->setExpectedException(ShortenerException::class);
        $this->app['config']->set('shortener.driver', 'foobar');
        $shortener = new Shortener();
    }

    protected function getShortenerWithMockedDriver($data,$driver = 'bitly'){
        if($driver==='bitly')
            $mock = $this->getMock(Bitly::class,[],['token']);

        $mock->expects($this->any())
             ->method('shorten')
             ->will($this->returnValue($data));

        return new Shortener(new BitlyDriver($mock));
    }
}
