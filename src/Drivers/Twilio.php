<?php

namespace Zenapply\Sms\Drivers;

use Services_Twilio as Service;

class Twilio implements SendsSms {

    protected $handle;

    public function __construct($auth_id, $auth_token){
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function send($msg,$to,$from){
        return $this->handle->account->messages->sendMessage($from, $to, $msg);
    }
}