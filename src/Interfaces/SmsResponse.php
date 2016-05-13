<?php

namespace Zenapply\Sms\Interfaces;

interface SmsResponse {
    public function successful();
    public function failed();
    public function getUUID();
}