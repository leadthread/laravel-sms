<?php

namespace LeadThread\Sms;

use Config;
use LeadThread\Sms\Exceptions\InvalidPhoneNumberException;
use LeadThread\Sms\Factories\DriverFactory;
use LeadThread\Sms\Factories\SearchFactory;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use LeadThread\Sms\Interfaces\SendsSms;
use LeadThread\Sms\Search\Search;
use LeadThread\Sms\Responses\Response;

class Sms
{
    protected $driver;
    protected $config;

    public function __construct(SendsSms $driver = null)
    {
        $this->config = (class_exists("Config") ? Config::get('sms') : []);
        $this->driver = $this->getDriver($driver);
    }

    /**
     * Returns a SMS driver instance
     * @param  mixed $driver An existing SMS driver instance to use
     * @return \LeadThread\Sms\Interfaces\SendsSms
     */
    protected function getDriver($driver = null)
    {
        if (!$driver instanceof SendsSms) {
            $factory = new DriverFactory;
            $driver = $factory->get($this->config['driver']);
        }
        return $driver;
    }

    /**
     * Gets all numbers on the account
     * @param  string $msg  The message to send
     * @param  mixed  $to   The number to send to
     * @param  number $from The number to send from
     * @return mixed        The response of the message
     */
    public function allNumbers()
    {
        return $this->driver->allNumbers();
    }

    /**
     * Sends an SMS message
     * @param  string $msg  The message to send
     * @param  mixed  $to   The number to send to
     * @param  number $from The number to send from
     * @return mixed        The response of the message
     */
    public function send($msg, $to, $from = null)
    {
        if (is_array($to)) {
            return $this->sendMany($msg, $to, $from);
        } else {
            return $this->driver->send($msg, $to, $from);
        }
    }

    /**
     * Sends the same message from the same number to many phone numbers
     * @param  string $msg  The message to send
     * @param  array  $tos  An array of numbers to send to
     * @param  number $from The number to send from
     * @return array        An array of responses per number
     */
    public function sendMany($msg, array $tos, $from = null)
    {
        return $this->driver->sendMany($msg, $tos, $from);
        // $resp = [];
        // foreach ($tos as $to) {
        //     $resp[] = $this->send($msg, $to, $from);
        // }
        // return $resp;
    }

    /**
     * An array of SMS items to send
     * @param  array $data Must contain msg, to, and from keys per item
     * @return array       An array of responses per item
     */
    public function sendArray(array $data)
    {
        $response = null;
        foreach ($data as $item) {
            $result = $this->send($item['msg'], $item['to'], $item['from']);
            if(!$response) 
                $response = $result;
            else
                $response->merge($result);
        }

        return $response;
    }

    protected function getSearchParams($search)
    {
        if (!$search instanceof PhoneSearchParams) {
            $f = new SearchFactory();
            return $f->get($this->config["driver"], $search);
        }
        return $search;
    }

    /**
     * Searches for a number and then purchases the first one it finds
     * @param  array $search Array of search options
     * @return \LeadThread\Sms\Responses\Response
     */
    public function searchAndBuyNumber($search)
    {
        return $this->driver->searchAndBuyNumber($this->getSearchParams($search));
    }

    public function searchNumber($search)
    {
        return $this->driver->searchNumber($this->getSearchParams($search));
    }

    public function buyNumber($number)
    {
        return $this->driver->buyNumber($number);
    }

    public function sellNumber($number)
    {
        return $this->driver->sellNumber($number);
    }
}
