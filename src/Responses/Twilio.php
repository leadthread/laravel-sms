<?php

namespace Zenapply\Sms\Responses;

use Zenapply\Sms\Interfaces\SmsResponse;

class Twilio extends Response
{
    public function applyResponse($response) {
        if(isset($response->error_message)){
            $this->error = $response->error_message;
        }
        if(isset($response->sid)){
            $this->uuid = $response->sid;
        }
    }

    public function successful(){
        return $this->error === null;
    }
}
