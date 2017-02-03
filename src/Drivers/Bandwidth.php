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
        $message = new Message(array(
            "from" => new PhoneNumber($from),
            "to" => new PhoneNumber($to),
            "text" => new TextMessage($msg),
            "callbackUrl" => $callback,
            "fallbackUrl" => $this->getFallbackUrl(),
            "applicationId" => $this->getApplicationId(),
        ));
        return new BandwidthResponse($message);
    }

    public function searchNumber(PhoneSearchParams $search)
    {
        $response = (new PhoneNumbers())->listLocal($search->toArray());
        return new BandwidthResponse($response);
    }

    public function buyNumber($phone)
    {
        $response = (new PhoneNumbers())->allocate(["number" => $phone]);
        return new BandwidthResponse($response);
    }

    public function sellNumber($phone)
    {
        throw new \Exception("Error Processing Request", 1);
    }

    protected function getFallbackUrl()
    {
        $x = $this->config["fallback_url"];
        return $x ? $x : null;
    }

    protected function getApplicationId()
    {
        $x = $this->config["application_id"];
        return $x ? $x : null;
    }
}
