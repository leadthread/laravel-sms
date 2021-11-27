<?php

namespace LeadThread\Sms\Responses;

use LeadThread\Sms\Interfaces\SmsResponse;

abstract class Response implements SmsResponse
{
    public $uuid;
    public $status;
    public $error;
    public $number;
    public $numbers;

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

    public function merge(Response $item): void
    {
        $this->error = $this->error ?: $item->error;
        $this->numbers[] = $item->number;
        $this->numbers = array_unique($this->numbers);
    }
}
