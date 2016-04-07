<?php

namespace Zenapply\Sms\Drivers\Twilio;

use Services_Twilio as Service;
use Zenapply\Sms\Drivers\Request as Base;

class Request extends Base {

    protected $handle;

    public function __construct($auth_id, $auth_token){
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function send($msg,$to,$from){
        return $this->handle->account->messages->sendMessage($from, $to, $msg);
    }
}