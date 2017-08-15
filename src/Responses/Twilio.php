<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;

class Twilio extends Response
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
            $this->numbers = collect($response->available_phone_numbers)->pluck("phone_number")->all();
        }
    }

    public function successful()
    {
        return $this->error === null;
    }
}
