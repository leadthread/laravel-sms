<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;

class Log extends Search
{
    protected function getBaseArray()
    {
        return [];
    }

    protected function handleParamKey($key, &$arr)
    {
        // Do nothing
    }
}
