<?php

namespace Zenapply\Sms\Drivers;

use Catapult\Client as Service;
use Catapult\Credentials;
use Catapult\Message;
use Catapult\PhoneNumber;
use Catapult\PhoneNumbers;
use Catapult\TextMessage;
use Config;
use Zenapply\Sms\Drivers\Driver;
use Zenapply\Sms\Exceptions\InvalidPhoneNumberException;
use Zenapply\Sms\Interfaces\PhoneSearchParams;
use Zenapply\Sms\Responses\Bandwidth as BandwidthResponse;
use Zenapply\Sms\Search\Bandwidth as Search;

class Bandwidth extends Driver
{
    protected $handle;

    public function __construct($secret, $token, $user_id)
    {
        $this->config = (class_exists("Config") ? Config::get('sms.bandwidth') : []);
        $cred = new Credentials($user_id, $token, $secret);
        $this->handle = new Service($cred);
    }

    public function send($msg, $to, $from, $callback = null)
    {
        return new BandwidthResponse(new Message(array(
            "from" => new PhoneNumber($from),
            "to" => new PhoneNumber($to),
            "text" => new TextMessage($msg, false),
            "callbackUrl" => $callback,
            "fallbackUrl" => $this->getFallbackUrl(),
        )));
    }

    public function searchNumber(PhoneSearchParams $search)
    {
        $response = (new PhoneNumbers())->listLocal($search->toArray());
        return new BandwidthResponse($response);
    }

    public function buyNumber($phone)
    {
        $response = (new PhoneNumbers())->allocate([
            "number" => $phone,
            "applicationId" => $this->getApplicationId(),
        ]);
        return new BandwidthResponse($response);
    }

    public function sellNumber($phone)
    {
        throw new \Exception("Error Processing Request", 1);
    }

    protected function getFallbackUrl()
    {
        return array_key_exists("fallback_url", $this->config) ? $this->config["fallback_url"] : null;
    }

    protected function getApplicationId()
    {
        return array_key_exists("application_id", $this->config) ? $this->config["application_id"] : null;
    }
}
