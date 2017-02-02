<?php

namespace Zenapply\Sms\Search;

use Illuminate\Contracts\Support\Arrayable;
use Zenapply\Sms\Interfaces\PhoneSearchParams;

abstract class Search implements Arrayable, PhoneSearchParams
{
    protected $params = [
        "state",
        "areacode",
        "country"
    ];

    protected $areacode;
    protected $country = "US";

    public function __construct($opts)
    {
        foreach ($opts as $key => $value) {
            if (in_array($key, $this->params)) {
                $this->{$key} = $value;
            }
        }
    }

    public function toArray()
    {
        $arr = [];
        foreach ($this->params as $key) {
            $arr[$key] = $this->{$key};
        }
        return $arr;
    }

    /**
     * Gets the value of areacode.
     *
     * @return mixed
     */
    public function getAreaCode()
    {
        return $this->areacode;
    }

    /**
     * Sets the value of areacode.
     *
     * @param mixed $areacode the areacode
     *
     * @return self
     */
    public function setAreaCode($areacode)
    {
        $this->areacode = $areacode;

        return $this;
    }

    /**
     * Gets the value of country.
     *
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the value of country.
     *
     * @param mixed $country the country
     *
     * @return self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
}
