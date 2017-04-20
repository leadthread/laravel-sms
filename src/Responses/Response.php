<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;

abstract class Response implements SmsResponse
{
    public $uuid;
    public $status;
    public $error;
    public $number;

    public function __construct($response)
    {
        $this->applyResponse($response);
    }

    abstract public function applyResponse($response);

    public function failed()
    {
        return !$this->successful();
    }

    public function getUUID()
    {
        return $this->uuid;
    }
}
