<?php

namespace Zenapply\Sms;

use Validator;
use Zenapply\Sms\Interfaces\SendsSms;
use Zenapply\Sms\Exceptions\InvalidPhoneNumberException;
use Zenapply\Sms\Factories\DriverFactory;
use Config;

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
     * @return \Zenapply\Sms\Interfaces\SendsSms
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
        $resp = [];
        foreach ($tos as $to) {
            $resp[] = $this->send($msg, $to, $from);
        }
        return $resp;
    }

    /**
     * An array of SMS items to send
     * @param  array $data Must contain msg, to, and from keys per item
     * @return array       An array of responses per item
     */
    public function sendArray(array $data)
    {
        $resp = [];
        foreach ($data as $item) {
            $resp[] = $this->send($item['msg'], $item['to'], $item['from']);
        }
        return $resp;
    }


    public function searchNumber($areacode, $country = 'US')
    {
        return $this->driver->searchNumber($areacode, $country);
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
