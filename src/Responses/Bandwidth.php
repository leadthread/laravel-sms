<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;
use Catapult\PhoneNumbersCollection;
use Catapult\PhoneNumbers;

class Bandwidth extends Response
{
    public function applyResponse($response)
    {
        if (isset($response->messageId)) {
            $this->uuid = $response->messageId;
        }
        if ($response instanceof PhoneNumbersCollection) {
            $this->number = $response->first()->number;
            $this->numbers = collect($response->toArray())->pluck("number")->all();
        }
        if ($response instanceof PhoneNumbers) {
            $this->number = $response->number;
        }
    }

    public function successful()
    {
        return $this->error === null;
    }
}
