<?php

namespace Zenapply\Sms\Interfaces;

interface SendsSms {
    public function send($msg,$to,$from);
}