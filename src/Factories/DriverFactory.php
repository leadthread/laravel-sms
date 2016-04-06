<?php

namespace Zenapply\Sms\Factories;

use Exception;
<<<<<<< HEAD
use Zenapply\Sms\Drivers\Plivo;
use Zenapply\Sms\Drivers\Twilio;
=======
use Zenapply\Sms\Drivers\Plivo\Request as Plivo;
>>>>>>> 51411dfd5dd84fe5d9c3a9383af7b96b7fe9fd3d

class DriverFactory
{

    /**
     * Creates a driver instance
     * @param  string $driver The driver instance to create
     * @return \Zenapply\Sms\Drivers\SendsSms
     */
    public function get($driver){
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
     * @return \Zenapply\Sms\Drivers\Plivo\Request
     */
    protected function plivo(array $config){
        return new Plivo($config['user'],$config['token']);
    }

    /**
     * Twilio
     * @param  array $config An array of config values for setting up the driver
     * @return \Zenapply\Sms\Drivers\Twilio
     */
    protected function twilio(array $config){
        return new Twilio($config['user'],$config['token']);
    }
}