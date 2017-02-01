<?php

namespace Zenapply\Sms\Providers;

use Illuminate\Support\ServiceProvider;
use Propaganistas\LaravelPhone\LaravelPhoneServiceProvider;
use Zenapply\Sms\Sms;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/sms.php', 'sms');

        $this->app->register(LaravelPhoneServiceProvider::class);

        $this->app->singleton('sms', function () {
            return new Sms;
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/sms.php' => base_path('config/sms.php'),
        ]);
    }
}
