<?php

namespace LeadThread\Sms\Tests\Responses;

use Catapult\DataPacketCollection;
use Catapult\PhoneNumber;
use Catapult\PhoneNumbersCollection;

class BandwidthTest extends TestCase
{
    protected $class = \LeadThread\Sms\Responses\Bandwidth::class;
    protected $driver = 'bandwidth';

    protected function getFakeResponse()
    {
        return new PhoneNumbersCollection(new DataPacketCollection(["data" => ["id"=>1, "number"=>"+18887776666"]]));
    }
}
