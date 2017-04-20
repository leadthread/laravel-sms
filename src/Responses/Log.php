<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;
use Catapult\PhoneNumbersCollection;
use Catapult\PhoneNumbers;

class Log extends Response
{
    public function applyResponse($response)
    {
        // Do nothing
    }

    public function successful()
    {
        return empty($this->error);
    }
}
