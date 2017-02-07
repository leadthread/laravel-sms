<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;
use Exception;

class Plivo extends Search
{
    protected function getBaseArray()
    {
        return ['type' => 'local', 'services' => 'sms'];
    }

    protected function handleParamKey($key, $arr)
    {
        switch ($key) {
            case 'areacode':
                $arr["pattern"] = $this->{$key};
                break;
            case 'country':
                $arr["country_iso"] = $this->{$key};
                break;
            case 'state':
                if (!empty($this->{$key})) {
                    throw new Exception("The \"state\" search parameter is not supported by Plivo", 1);
                }
                break;
            default:
                $arr[$key] = $this->{$key};
                break;
        }
    }
}
