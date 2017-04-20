<?php

namespace LeadThread\Sms\Drivers;

use LeadThread\Sms\Responses\Log as Response;
use LeadThread\Sms\Drivers\Driver;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use Illuminate\Support\Facades\Log as Writer;

class Log extends Driver
{
    public function __construct()
    {
        $this->config = [];
    }

    public function send($msg, $to, $from, $callback = null)
    {
        Writer::info("$to|$msg");
        return new Response();
    }

    public function searchNumber(PhoneSearchParams $search)
    {

    }

    public function buyNumber($phone)
    {

    }

    public function sellNumber($phone)
    {

    }
}
