<?php

namespace LeadThread\Sms\Tests\Responses;

use Catapult\DataPacketCollection;
use BandwidthLib;

class BandwidthTest extends TestCase
{
    protected $class = \LeadThread\Sms\Responses\Bandwidth::class;
    protected $driver = 'bandwidth';

    protected function getFakeResponse()
    {
        return new BandwidthLib\Http\ApiResponse(202, [], new BandwidthLib\Messaging\Models\BandwidthMessage(
            "1637633782603uhik3lsbg5phtzua",
            "+13853008713",
            "4ec988e7-f6d1-4918-800e-4b3f8204ae1a",
            "2021-11-23T02:16:22.603Z",
            1,
            "out",
            [
            "+13852017374"
            ],
            "+13853008713",
            null,
            "message",
            null,
            null,
        ));
    }
}
