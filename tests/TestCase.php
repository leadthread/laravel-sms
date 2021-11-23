<?php

namespace LeadThread\Sms\Tests;

use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    /**
     * Setup the test environment.
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageProviders($app)
    {
        return ['LeadThread\Sms\Providers\SmsServiceProvider'];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getPackageAliases($app)
    {
        return [
            'Sms' => 'LeadThread\Sms\Facades\Sms'
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('sms', [
            'driver' => 'plivo',
            'plivo' => [
                'token' => 'Token',
                'user'  => 'User',
                'from'  => '+1 (555) 555-5555', //Default from phone number
            ],
            'twilio' => [
                'token' => 'Token',
                'user'  => 'User',
                'from'  => '+1 (555) 555-5555', //Default from phone number
            ],
            'bandwidth' => [
                "auth" => [
                    'messagingBasicAuthUserName' => 'BANDWIDTH_TOKEN',
                    'messagingBasicAuthPassword' => 'BANDWIDTH_SECRET',
                    'voiceBasicAuthUserName' => 'BANDWIDTH_TOKEN',
                    'voiceBasicAuthPassword' => 'BANDWIDTH_SECRET',
                    'twoFactorAuthBasicAuthUserName' => 'BANDWIDTH_TOKEN',
                    'twoFactorAuthBasicAuthPassword' => 'BANDWIDTH_SECRET',
                    'webRtcBasicAuthUserName' => 'BANDWIDTH_TOKEN',
                    'webRtcBasicAuthPassword' => 'BANDWIDTH_SECRET',
                ],
                'accountId' => 'BANDWIDTH_ACCOUNT_ID',
                'from'  => 'BANDWIDTH_FROM',
                'fallbackUrl' => 'BANDWIDTH_FALLBACK_URL',
                'applicationId' => 'BANDWIDTH_APPLICATION_ID',
            ],
        ]);
    }

    /**
     * Call protected/private method of a class.
     *
     * @param object &$object    Instantiated object that we will run method on.
     * @param string $methodName Method name to call
     * @param array  $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    protected function getMock($class, $methods = [], $contructorArgs = []) {
        return $this->getMockBuilder($this->class)->onlyMethods($methods)->setConstructorArgs($contructorArgs)->getMock();

    }
}
