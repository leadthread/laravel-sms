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
        "auth" => [
            'messagingBasicAuthUserName' => env('BANDWIDTH_TOKEN'),
            'messagingBasicAuthPassword' => env('BANDWIDTH_SECRET'),
            'voiceBasicAuthUserName' => env('BANDWIDTH_TOKEN'),
            'voiceBasicAuthPassword' => env('BANDWIDTH_SECRET'),
            'twoFactorAuthBasicAuthUserName' => env('BANDWIDTH_TOKEN'),
            'twoFactorAuthBasicAuthPassword' => env('BANDWIDTH_SECRET'),
            'webRtcBasicAuthUserName' => env('BANDWIDTH_TOKEN'),
            'webRtcBasicAuthPassword' => env('BANDWIDTH_SECRET'),
        ],
        'accountId' => env('BANDWIDTH_ACCOUNT_ID', null),
        'from'  => env('BANDWIDTH_FROM', null), //Default from phone number
        'fallbackUrl' => env('BANDWIDTH_FALLBACK_URL', null),
        'applicationId' => env('BANDWIDTH_APPLICATION_ID', null),
    ],
];
