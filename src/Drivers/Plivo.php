<?php

namespace Zenapply\Sms\Drivers;

use Plivo\RestAPI as Service;
use Zenapply\Sms\Drivers\Driver;

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

        return $this->handle->send_message($params);
    }

    public function searchNumber($areacode,$country = 'US'){
        $params = [
            'country_iso' => $country,
            'type' => 'local',
            'pattern' => $areacode,
            'services' => 'sms',
        ];

        return $this->handle->search_phone_numbers($params);
    }

    public function buyNumber($phone){
        $params = [
            'number' => $phone
        ];

        return $this->handle->buy_phone_number($params);
    }

    public function sellNumber($phone){
        $params = [
            'number' => $phone
        ];

        return $this->handle->unrent_number($params);
    }
}