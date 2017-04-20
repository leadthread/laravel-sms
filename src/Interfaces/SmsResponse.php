<?php

namespace LeadThread\Sms\Interfaces;

interface SmsResponse {
    public function successful();
    public function failed();
    public function getUUID();
}