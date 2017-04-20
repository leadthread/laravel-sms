<?php

namespace LeadThread\Sms\Factories;

use Exception;
use LeadThread\Sms\Drivers\Plivo;
use LeadThread\Sms\Drivers\Twilio;
use LeadThread\Sms\Drivers\Bandwidth;

class DriverFactory
{

    /**
     * Creates a driver instance
     * @param  string $driver The driver instance to create
     * @return \LeadThread\Sms\Drivers\SendsSms
     */
    public function get($driver)
    {
        $config = config("sms.{$driver}");
        if (is_array($config)) {
            return $this->{$driver}($config);
        } else {
            throw new Exception("config must be an array! You may have chosen an unsupported SMS driver.");
        }
    }

    /**
     * Plivo
     * @param  array $config An array of config values for setting up the driver
     * @return \LeadThread\Sms\Drivers\Plivo\Request
     */
    protected function plivo(array $config)
    {
        return new Plivo($config['user'], $config['token']);
    }

    /**
     * Twilio
     * @param  array $config An array of config values for setting up the driver
     * @return \LeadThread\Sms\Drivers\Twilio
     */
    protected function twilio(array $config)
    {
        return new Twilio($config['user'], $config['token']);
    }

    /**
     * Bandwidth
     * @param  array $config An array of config values for setting up the driver
     * @return \LeadThread\Sms\Drivers\Bandwidth
     */
    protected function bandwidth(array $config)
    {
        return new Bandwidth($config['secret'], $config['token'], $config['user_id']);
    }
}