<?php

namespace LeadThread\Sms\Drivers;

use Exception;
use Twilio\Rest\Client as Service;
use LeadThread\Sms\Drivers\Driver;
use LeadThread\Sms\Exceptions\InvalidPhoneNumberException;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use LeadThread\Sms\Responses\Twilio as TwilioResponse;
use LeadThread\Sms\Exceptions;

class Twilio extends Driver
{
    protected $handle;
    protected $auth_id;

    public function __construct($auth_id, $auth_token)
    {
        $this->auth_id = $auth_id;
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function allNumbers(): TwilioResponse
    {
        // throw new Exception\NotImplementedException();
    }

    public function sendMany($msg, $tos, $from = null): TwilioResponse
    {
        $this->send($msg, $tos, $from);
    }

    public function send($msg, $to, $from, $callback = null): TwilioResponse
    {
        if (!empty($callback)) {
            throw new \Exception("Callback URLs are not implemented for Twilio", 1);
        }
        
        return new TwilioResponse($this->handle->account->messages->sendMessage($from, $to, $msg));
    }

    public function searchNumber(PhoneSearchParams $search): TwilioResponse
    {
        $resp = $this->handle->account->available_phone_numbers
            ->getList($search->getCountry(), 'Local', $search->toArray());

        return new TwilioResponse($resp);
    }

    public function buyNumber($phone): TwilioResponse
    {
        $resp = $this->handle->account->incoming_phone_numbers->create(array(
            "PhoneNumber" => $phone,
        ));

        return new TwilioResponse($resp);
    }

    public function sellNumber($phone): TwilioResponse
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
