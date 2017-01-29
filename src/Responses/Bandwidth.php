<?php

namespace Zenapply\Sms\Responses;

use Zenapply\Sms\Interfaces\SmsResponse;

class Bandwidth extends Response
{
    public function applyResponse($response)
    {
        if (isset($response->error_message)) {
            $this->error = $response->error_message;
        }
        if (isset($response->sid)) {
            $this->uuid = $response->sid;
        }
        if (!empty($response->available_phone_numbers)) {
            $this->number = $response->available_phone_numbers[0]->phone_number;
        }
    }

    public function successful()
    {
        return $this->error === null;
    }
}
