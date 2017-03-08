<?php

namespace Zenapply\Sms\Factories;

use Exception;
use Zenapply\Sms\Drivers\Bandwidth;
use Zenapply\Sms\Drivers\Log;
use Zenapply\Sms\Drivers\Plivo;
use Zenapply\Sms\Drivers\Twilio;

class DriverFactory
{

    /**
     * Creates a driver instance
     * @param  string $driver The driver instance to create
     * @return \Zenapply\Sms\Drivers\SendsSms
     */
    public function get($driver)
    {
        if ($driver === 'log') {
            $config = [];
        } else {
            $config = config("sms.{$driver}");
        }

        if (is_array($config)) {
            return $this->{$driver}($config);
        } else {
            throw new Exception("config must be an array! You may have chosen an unsupported SMS driver.");
        }
    }

    /**
     * Log
     * @param  array $config An array of config values for setting up the driver
     * @return \Zenapply\Sms\Drivers\Log
     */
    protected function log(array $config)
    {
        return new Log();
    }

    /**
     * Plivo
     * @param  array $config An array of config values for setting up the driver
     * @return \Zenapply\Sms\Drivers\Plivo
     */
    protected function plivo(array $config)
    {
        return new Plivo($config['user'], $config['token']);
    }

    /**
     * Twilio
     * @param  array $config An array of config values for setting up the driver
     * @return \Zenapply\Sms\Drivers\Twilio
     */
    protected function twilio(array $config)
    {
        return new Twilio($config['user'], $config['token']);
    }

    /**
     * Bandwidth
     * @param  array $config An array of config values for setting up the driver
     * @return \Zenapply\Sms\Drivers\Bandwidth
     */
    protected function bandwidth(array $config)
    {
        return new Bandwidth($config['secret'], $config['token'], $config['user_id']);
    }
}