<?php

namespace Leadthread\Sms\Interfaces;

interface SendsSms
{
    public function send($msg, $to, $from, $callback);
}
