<?php

namespace LeadThread\Sms\Tests\Drivers;

use LeadThread\Sms\Sms;
use Config;
use LeadThread\Sms\Responses;
use BandwidthLib;

class BandwidthTest extends TestCase
{
    protected $class = \LeadThread\Sms\Drivers\Bandwidth::class;
    protected $driver = 'bandwidth';

    protected function getBandwidthMessage($to = "to", $from = "from") {
        return new BandwidthLib\Messaging\Models\BandwidthMessage(
            "id",
            "owner",
            "applicationId",
            "time",
            "segmentCount",
            "direction",
            $to,
            $from,
            "media",
            "text",
            "tag",
            "priority"
        );
    }

    protected function getMockReturns($testName) {
        switch($testName) {
            case 'testSmsSend':
                return [
                    'send' => new Responses\Bandwidth(new BandwidthLib\Http\ApiResponse(201, [], $this->getBandwidthMessage("to", "+13853008713")))
                ];
            case 'testAllNumbers':
                return [
                    'inServiceNumbers' => new \Iris\TelephoneNumbers(["TelephoneNumber" => ["+18885559999"]])
                ];
            case 'testSmsSendMany':
                return [
                    'send' => new Responses\Bandwidth(new BandwidthLib\Http\ApiResponse(201, [], $this->getBandwidthMessage("to", "+13853008713")))
                ];
            case 'testSmsSendArray':
                return [
                    'send' => new Responses\Bandwidth(new BandwidthLib\Http\ApiResponse(201, [], $this->getBandwidthMessage("to", "+13853008713")))
                ];
            default:
                return  [
                    'inServiceNumbers' => new \Iris\TelephoneNumbers(["TelephoneNumber" => ["+18885559999"]])
                ];
        }
    }

    protected function getSmsInstanceWithMockedDriver(array $returns = [])
    {
        $auth = Config::get("sms.{$this->driver}.auth", [
            'messagingBasicAuthUserName' => null,
            'messagingBasicAuthPassword' => null,
        ]);        
        $accountId = Config::get("sms.{$this->driver}.accountId", "account");        
        $applicationId = Config::get("sms.{$this->driver}.applicationId", "application");        

        // return new Sms(new $this->class($auth, $accountId, $applicationId));
        $mock = $this->getMock($this->class, ['send', 'getIrisAccount'], [$auth, $accountId, $applicationId]);
        
        if(array_key_exists('send', $returns))
            $mock->expects($this->any())
                ->method('send')
                ->willReturn($returns['send']);

        $mock->method('getIrisAccount')->willReturn($this->getMockedIrisAccount($returns));

        return new Sms($mock);
    }

    protected function getMockedIrisAccount(array $returns)
    {
        $mock = $this->getMock(\Iris\Account::class, ['inServiceNumbers'], ["account", new \Iris\Client("username", "password", ['url' => 'http://localhost'])]);
        
        if(array_key_exists('inServiceNumbers', $returns))
            $mock->expects($this->any())
                ->method('inServiceNumbers')
                ->willReturn($returns['inServiceNumbers']);

        return $mock;
    }
}


