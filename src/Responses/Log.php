<?php

namespace Zenapply\Sms\Responses;

use Zenapply\Sms\Interfaces\SmsResponse;
use Catapult\PhoneNumbersCollection;
use Catapult\PhoneNumbers;

class Log extends Response
{
    public function applyResponse($response)
    {
    }

    public function successful()
    {
        return empty($this->error);
    }
}
