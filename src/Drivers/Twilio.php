<?php

namespace Zenapply\Sms\Drivers;

use Services_Twilio as Service;
use Zenapply\Sms\Drivers\Driver;

class Twilio extends Driver {

    protected $handle;

    protected $auth_id;

    public function __construct($auth_id, $auth_token){
        $this->auth_id = $auth_id;
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function send($msg,$to,$from){
        return $this->handle->account->messages->sendMessage($from, $to, $msg);
    }

    public function searchNumber($areacode,$country = 'US'){
        $resp = $this->handle->account->available_phone_numbers->getList($country, 'Local', [
            "AreaCode" => $areacode,
            "Sms" => true,
        ]);

        return $this->respond($resp);
    }

    public function buyNumber($phone){
        $resp = $this->handle->account->incoming_phone_numbers->create(array(
            "PhoneNumber" => $phone,
        ));
        return $this->respond($resp);
    }

    public function sellNumber($phone){
        $resp = $this->handle->account->incoming_phone_numbers->delete($this->auth_id,array(
            "PhoneNumber" => $phone,
        ));
        return $this->respond($resp);
    }

    private function respond($data){
        return json_decode(json_encode($data), true);
    }
}