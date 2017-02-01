<?php

namespace Zenapply\Sms\Drivers;

use Exception;
use Twilio\Rest\Client as Service;
use Zenapply\Sms\Drivers\Driver;
use Zenapply\Sms\Exceptions\InvalidPhoneNumberException;
use Zenapply\Sms\Responses\Twilio as TwilioResponse;

class Twilio extends Driver
{

    protected $handle;

    protected $auth_id;

    public function __construct($auth_id, $auth_token)
    {
        $this->auth_id = $auth_id;
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function send($msg, $to, $from, $callback = null)
    {
        if (!empty($callback)) {
            throw new \Exception("Callback URLs are not implemented for Twilio", 1);
        }
        return new TwilioResponse($this->handle->account->messages->sendMessage($from, $to, $msg));
    }

    public function searchNumber($search)
    {
        if (!is_array($search)) {
            throw new Exception("Argument #1 must be an array");
        }

        $opts = [
            "AreaCode" => $search["areacode"],
            "Sms" => true,
        ];

        $resp = $this->handle->account->available_phone_numbers->getList($search["country"], 'Local', $opts);

        return new TwilioResponse($resp);
    }

    public function buyNumber($phone)
    {
        $resp = $this->handle->account->incoming_phone_numbers->create(array(
            "PhoneNumber" => $phone,
        ));
        return new TwilioResponse($resp);
    }

    public function sellNumber($phone)
    {
        $sid = false;

        foreach ($this->handle->account->incoming_phone_numbers as $number) {
            if ($phone == $number->phone_number) {
                $sid = $number->sid;
            }
        }
        
        if (empty($sid)) {
            throw new InvalidPhoneNumberException("The phone number '{$phone}' could not be found on your account!");
        }

        $resp = $this->handle->account->incoming_phone_numbers->delete($sid);
        return new TwilioResponse($resp);
    }
}
