<?php

namespace Zenapply\Sms\Drivers\Plivo;

use Plivo\RestAPI as Service;
use Zenapply\Sms\Drivers\Request as Base;

class Request extends Base {

    protected $handle;

    public function __construct($auth_id, $auth_token){
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function send($msg,$to,$from){
        $params = [
            'src'  => $from,
            'dst'  => $to,
            'text' => $msg,
            'type' => 'sms'
        ];

        return $this->handle->send_message($params);
    }
}