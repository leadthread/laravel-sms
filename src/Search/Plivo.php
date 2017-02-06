<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;

class Plivo extends Search
{
    public function toArray()
    {
        $arr = ['type' => 'local', 'services' => 'sms'];
        foreach ($this->params as $key) {
            switch ($key) {
                case 'areacode':
                    $arr["pattern"] = $this->{$key};
                    break;
                case 'country':
                    $arr["country_iso"] = $this->{$key};
                    break;
                case 'state':
                    throw new Exception("The \"state\" search parameter is not supported by Twilio", 1);
                default:
                    $arr[$key] = $this->{$key};
                    break;
            }
        }
        return $arr;
    }
}
