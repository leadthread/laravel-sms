<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;
use Exception;

class Twilio extends Search
{
    protected function getBaseArray()
    {
        return ["Sms" => true];
    }

    protected function handleParamKey($key, $arr)
    {
        switch ($key) {
            case 'areacode':
                $arr["AreaCode"] = $this->{$key};
                break;
            case 'state':
                if (!empty($this->{$key})) {
                    throw new Exception("The \"state\" search parameter is not supported by Twilio", 1);
                }
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
