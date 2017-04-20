<?php

namespace LeadThread\Sms\Providers;

use Illuminate\Support\ServiceProvider;
use LeadThread\Sms\Sms;

class SmsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/sms.php', 'sms');

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
