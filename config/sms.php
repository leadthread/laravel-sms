<?php

return [

    /**
     * The SMS service to use. twilio or plivo
     */
    'driver' => env('SMS_DRIVER', 'bandwidth'),

    // /**
    //  * Plivo settings
    //  */
    // 'plivo' => [
    //     'token' => env('PLIVO_AUTH_TOKEN'),
    //     'user'  => env('PLIVO_AUTH_ID'),
    //     'from'  => env('PLIVO_FROM', null), //Default from phone number
    // ],

    /**
     * Twilio settings
     */
    'twilio' => [
        'token' => env('TWILIO_AUTH_TOKEN'),
        'user'  => env('TWILIO_AUTH_SID'),
        'from'  => env('TWILIO_FROM', null), //Default from phone number
    ],

    /**
     * Bandwidth settings
     */
    'bandwidth' => [
        "client" => [
            'messagingBasicAuthUserName' => env('BANDWIDTH_USERNAME'),
            'messagingBasicAuthPassword' => env('BANDWIDTH_PASSWORD'),
            'voiceBasicAuthUserName' => env('BANDWIDTH_USERNAME'),
            'voiceBasicAuthPassword' => env('BANDWIDTH_PASSWORD'),
            'twoFactorAuthBasicAuthUserName' => env('BANDWIDTH_USERNAME'),
            'twoFactorAuthBasicAuthPassword' => env('BANDWIDTH_PASSWORD'),
            'webRtcBasicAuthUserName' => env('BANDWIDTH_USERNAME'),
            'webRtcBasicAuthPassword' => env('BANDWIDTH_PASSWORD'),
        ],
        'username' => env('BANDWIDTH_USERNAME'),
        'password' => env('BANDWIDTH_PASSWORD'),
        'accountId' => env('BANDWIDTH_ACCOUNT_ID', null),
        'from'  => env('BANDWIDTH_FROM', null), //Default from phone number
        'fallbackUrl' => env('BANDWIDTH_FALLBACK_URL', null),
        'applicationId' => env('BANDWIDTH_APPLICATION_ID', null),
    ],
];
