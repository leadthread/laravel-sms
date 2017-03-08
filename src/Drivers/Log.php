<?php

namespace Zenapply\Sms\Drivers;

use Zenapply\Sms\Responses\Log as Response;
use Zenapply\Sms\Drivers\Driver;
use Zenapply\Sms\Interfaces\PhoneSearchParams;
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
