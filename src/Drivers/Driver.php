<?php

namespace LeadThread\Sms\Drivers;

use LeadThread\Sms\Interfaces\SendsSms;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use LeadThread\Sms\Responses\Response;

abstract class Driver implements SendsSms
{
    protected $config = [];
    
    abstract public function send($msg, $to, $from = null, $callback = null): Response;
    abstract public function sendMany($msg, array $tos, $from = null, $callback = null): Response;
    abstract public function searchNumber(PhoneSearchParams $search): Response;
    abstract public function allNumbers(): Response;
    abstract public function buyNumber($phone): Response;
    abstract public function sellNumber($phone): Response;

    /**
     * Searches for a number and then purchases the first one it finds
     * @param  array $search Array of search options
     * @return \LeadThread\Sms\Responses\Response
     */
    public function searchAndBuyNumber(PhoneSearchParams $search): Response
    {
        $resp = $this->searchNumber($search);
        return $this->buyNumber($resp->number);
    }
}
