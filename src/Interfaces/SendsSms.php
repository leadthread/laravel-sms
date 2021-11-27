<?php

namespace LeadThread\Sms\Interfaces;

interface SendsSms
{
    public function send($msg, $to, $from = null, $callback = null);
    public function sendMany($msg, array $tos, $from = null, $callback = null);
}
