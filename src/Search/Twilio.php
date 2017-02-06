<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;
use Exception;

class Twilio extends Search
{
    public function toArray()
    {
        $arr = ["Sms" => true];
        foreach ($this->params as $key) {
            switch ($key) {
                case 'areacode':
                    $arr["AreaCode"] = $this->{$key};
                    break;
                case 'state':
                    throw new Exception("The \"state\" search parameter is not supported by Twilio", 1);
                case 'country':
                    //do nothing
                    break;
                default:
                    $arr[$key] = $this->{$key};
                    break;
            }
        }
        return $arr;
    }
}
