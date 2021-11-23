<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;
use BandwidthLib;

class Bandwidth extends Response
{
    public function applyResponse($response)
    {
        if($response) {

            $this->status = $response ? $response->getStatusCode() : null;
            $result = $response->getResult();
            if (isset($result->id)) {
                $this->uuid = $result->id;
            }
            // if ($result instanceof PhoneNumbersCollection) {
            //     $this->number = $result->first()->number;
            //     $this->numbers = collect($result->toArray())->pluck("number")->all();
            // }
            if ($result instanceof BandwidthLib\Messaging\Models\BandwidthMessage) {
                $this->number = collect($result->from)->first();
            }
        }
        
    }

    public function successful()
    {
        return $this->error === null;
    }
}
