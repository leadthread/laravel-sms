<?php

namespace LeadThread\Sms\Drivers;

use BandwidthLib;
use Config;
use LeadThread\Sms\Drivers\Driver;
use LeadThread\Sms\Exceptions\InvalidPhoneNumberException;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use LeadThread\Sms\Responses\Bandwidth as BandwidthResponse;
use LeadThread\Sms\Search\Bandwidth as Search;

class Bandwidth extends Driver
{
    protected $handle;

    public function __construct($auth, $accountId, $applicantionId)
    {
        $this->config = (class_exists("Config") ? Config::get('sms.bandwidth') : []);
        $this->accountId = $accountId;
        $this->applicationId = $applicantionId;
        $config = new BandwidthLib\Configuration($auth);
        $this->handle = new BandwidthLib\BandwidthClient($config);
        // ///
        // $this->config = (class_exists("Config") ? Config::get('sms.bandwidth') : []);
        // $cred = new Credentials($user_id, $token, $secret);
        // $this->handle = new Service($cred);
        
        // // Turn off the logger
        // \Catapult\Log::on(false);
    }

    public function send($msg, $to, $from, $applicationId = null, $callback = null)
    {
        $client = $this->handle->getMessaging()->getClient();

        $body = new BandwidthLib\Messaging\Models\MessageRequest();
        $body->from = $from;
        $body->to = is_array($to) ? $to : [$to];
        $body->applicationId = $applicationId ?: $this->applicationId;
        $body->text = $msg;
        // dd([$this->accountId, $body]);
        $response = $client->createMessage($this->accountId, $body);
        return new BandwidthResponse($response);
        // return new BandwidthResponse(new Message(array(
        //     "from" => new PhoneNumber($from),
        //     "to" => new PhoneNumber($to),
        //     "text" => $msg,
        //     "callbackUrl" => $callback,
        //     "fallbackUrl" => $this->getFallbackUrl(),
        //     "receiptRequested" => "all",
        // )));
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
