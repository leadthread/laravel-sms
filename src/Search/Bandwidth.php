<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;

class Bandwidth extends Search
{
    public function toArray()
    {
        $arr = [];
        foreach ($this->params as $key) {
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
        return $arr;
    }
}
