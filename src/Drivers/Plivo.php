<?php

namespace Zenapply\Sms\Drivers;

use Plivo\RestAPI as Service;
use Zenapply\Sms\Drivers\Driver;
use Zenapply\Sms\Responses\Plivo as PlivoResponse;

class Plivo extends Driver {

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

        return new PlivoResponse($this->handle->send_message($params));
    }

    public function searchNumber($areacode,$country = 'US'){
        $params = [
            'country_iso' => $country,
            'type' => 'local',
            'pattern' => $areacode,
            'services' => 'sms',
        ];

        return new PlivoResponse($this->handle->search_phone_numbers($params));
    }

    public function buyNumber($phone){
        $params = [
            'number' => $phone
        ];

        return new PlivoResponse($this->handle->buy_phone_number($params));
    }

    public function sellNumber($phone){
        $phone = str_replace("+","",$phone);
        $params = [
            'number' => $phone
        ];
        return new PlivoResponse($this->handle->unrent_number($params));
    }
}