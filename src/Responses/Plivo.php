<?php

namespace Zenapply\Sms\Responses;

use Zenapply\Sms\Interfaces\SmsResponse;

class Plivo extends Response
{
    public function applyResponse($response) {
        if(isset($response['response'])){
            if(isset($response['response']['error'])){
                $this->error = $response['response']['error'];
            }
            if(isset($response['response']['message_uuid'])){
                $this->uuid = $response['response']['message_uuid'][0];
            }
        }

        if(isset($response['status'])){
            $this->status = $response["status"];
        }
    }

    public function successful(){
        return $this->status >= 200 && $this->status < 300;
    }
}
