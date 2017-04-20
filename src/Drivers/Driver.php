<?php

namespace LeadThread\Sms\Drivers;

use LeadThread\Sms\Interfaces\SendsSms;
use LeadThread\Sms\Interfaces\PhoneSearchParams;

abstract class Driver implements SendsSms
{
    protected $config = [];
    
    abstract public function searchNumber(PhoneSearchParams $search);
    abstract public function buyNumber($phone);
    abstract public function sellNumber($phone);

    /**
     * Searches for a number and then purchases the first one it finds
     * @param  array $search Array of search options
     * @return \LeadThread\Sms\Responses\Response
     */
    public function searchAndBuyNumber(PhoneSearchParams $search)
    {
        $resp = $this->searchNumber($search);
        return $this->buyNumber($resp->number);
    }
}
