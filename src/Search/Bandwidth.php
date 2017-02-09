<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;

class Bandwidth extends Search
{
    protected function getBaseArray()
    {
        return [];
    }

    protected function handleParamKey($key, &$arr)
    {
        switch ($key) {
            case 'areacode':
                $arr["areaCode"] = $this->{$key};
                break;
            case 'country':
                //do nothing
                break;
            default:
                $arr[$key] = $this->{$key};
                break;
        }
    }
}
