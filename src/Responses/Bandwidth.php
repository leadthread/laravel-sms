<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;
use BandwidthLib;
use Iris;

class Bandwidth extends Response
{
    public function applyResponse($response)
    {
        if($response instanceof BandwidthLib\Http\ApiResponse) {
            return $this->handleUnirestResponse($response);
        }
        if($response instanceof Iris\TelephoneNumbers) {
            return $this->handleIrisTelephoneNumbers($response);
        }
        throw new \Exception("Could not generate a response with the provided class: ".get_class($response));
    }

    protected function handleIrisTelephoneNumbers($response)
    {
        $this->numbers = is_array($response->TelephoneNumber) ? $response->TelephoneNumber : [$response->TelephoneNumber];
        $this->number = $this->numbers[0];
    }

    protected function handleUnirestResponse(BandwidthLib\Http\ApiResponse $response): void
    {
        $this->status = $response ? $response->getStatusCode() : null;
        $result = $response->getResult();
        if (isset($result->id)) {
            $this->uuid = $result->id;
        }
        if ($result instanceof BandwidthLib\Messaging\Models\BandwidthMessage) {
            $this->numbers = collect($result->from)->toArray();
            $this->number = collect($result->from)->first();
        }
    }

    public function successful()
    {
        return $this->error === null;
    }
}
