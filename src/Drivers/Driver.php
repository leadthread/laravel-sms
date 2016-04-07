<?php

namespace Zenapply\Sms\Drivers;

abstract class Driver implements SendsSms
{
    abstract public function searchNumber($areacode,$country);
    abstract public function buyNumber($phone);
    abstract public function sellNumber($phone);
}