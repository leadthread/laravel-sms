<?php

namespace Zenapply\Sms\Drivers;

interface SendsSms {
    public function send($msg,$to,$from);
}