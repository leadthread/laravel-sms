<?php

namespace LeadThread\Sms\Drivers;

use BandwidthLib;
use Config;
use LeadThread\Sms\Drivers\Driver;
use LeadThread\Sms\Exceptions\InvalidPhoneNumberException;
use LeadThread\Sms\Interfaces\PhoneSearchParams;
use LeadThread\Sms\Responses\Bandwidth as BandwidthResponse;
use LeadThread\Sms\Search\Bandwidth as Search;
use LeadThread\Sms\Responses\Response;

class Bandwidth extends Driver
{
    protected $handle;
    protected $config;
    protected $irisAccount;
    protected $password;
    protected $username;

    public function __construct($config)
    {
        $this->config = $config;
        $this->accountId = $config['accountId'];
        $this->applicationId = $config['applicationId'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->config = $config;
        $this->handle = new BandwidthLib\BandwidthClient( new BandwidthLib\Configuration($config['client']));
    }

    public function setIrisAccount(\Iris\Account $irisAccount): void
    {
        $this->irisAccount = $irisAccount;
    }

    public function getIrisAccount(): \Iris\Account
    {
        if(!$this->irisAccount) {
            $client = new \Iris\Client($this->username, $this->password, ['url' => 'https://dashboard.bandwidth.com/api/']);
            $this->irisAccount = new \Iris\Account($this->accountId, $client);
        }
        return $this->irisAccount;
    }

    protected function getMessagingClient()
    {
        return $this->handle->getMessaging()->getClient();
    }

    public function allNumbers(): BandwidthResponse
    {
        return new BandwidthResponse($this->getIrisAccount()->inServiceNumbers());
    }

    public function sendMany($msg, array $tos, $from = null, $callback = null): BandwidthResponse
    {
        return $this->send($msg, $tos, $from, $callback);
    }

    public function send($msg, $to, $from = null, $callback = null): BandwidthResponse
    {
        $client = $this->getMessagingClient();

        $body = new BandwidthLib\Messaging\Models\MessageRequest();
        $body->from = $from;
        $body->to = is_array($to) ? $to : [$to];
        $body->applicationId = $this->applicationId;
        $body->text = $msg;
        $response = $client->createMessage($this->accountId, $body);
        return new BandwidthResponse($response);
    }

    public function searchNumber(PhoneSearchParams $search): BandwidthResponse
    {
        $response = (new PhoneNumbers())->listLocal($search->toArray());
        return new BandwidthResponse($response);
    }

    public function buyNumber($phone): BandwidthResponse
    {
        $response = (new PhoneNumbers())->allocate([
            "number" => $phone,
            "applicationId" => $this->getApplicationId(),
        ]);
        return new BandwidthResponse($response);
    }

    public function sellNumber($phone): BandwidthResponse
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
