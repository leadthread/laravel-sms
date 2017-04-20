<?php

namespace Leadthread\Sms\Tests\Responses;

class PlivoTest extends TestCase
{
    protected $class = \Leadthread\Sms\Responses\Plivo::class;
    protected $driver = 'plivo';

    protected function getFakeResponse()
    {
        return [
            "available_phone_numbers" => [
                [
                    "phone_number" => "+18887776666"
                ]
            ],
        ];
    }
}
