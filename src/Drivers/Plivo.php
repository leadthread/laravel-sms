<?php

namespace LeadThread\Sms\Drivers;

use Plivo\RestAPI as Service;
use LeadThread\Sms\Drivers\Driver;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use LeadThread\Sms\Responses\Plivo as PlivoResponse;
use Symfony;
use LeadThread\Sms\Responses\Response;
use LeadThread\Sms\Exceptions;

class Plivo extends Driver
{

    protected $handle;

    public function __construct($auth_id, $auth_token)
    {
        $this->handle = new Service($auth_id, $auth_token);
    }

    public function allNumbers(): PlivoResponse
    {
        throw new Exceptions\NotImplementedException();
    }

    public function sendMany($msg, array $tos, $from = null, $callback = null): PlivoResponse
    {
        $this->send($msg, $tos, $from);
    }

    public function send($msg, $to, $from = null, $callback = null): PlivoResponse
    {
        if (!empty($callback)) {
            throw new \Exception("Callback URLs are not implemented for Plivo", 1);
        }

        $params = [
            'src'  => $from,
            'dst'  => $to,
            'text' => $msg,
            'type' => 'sms'
        ];

        return new PlivoResponse($this->handle->send_message($params));
    }

    public function searchNumber(PhoneSearchParams $search): PlivoResponse
    {
        return new PlivoResponse($this->handle->search_phone_numbers($search->toArray()));
    }

    public function buyNumber($phone)
    {
        $params = [
            'number' => $phone
        ];

        return new PlivoResponse($this->handle->buy_phone_number($params));
    }

    public function sellNumber($phone): PlivoResponse
    {
        $phone = str_replace("+", "", $phone);
        $params = [
            'number' => $phone
        ];
        return new PlivoResponse($this->handle->unrent_number($params));
    }
}
