<?php

return [

    /**
     * The SMS service to use
     */
    'driver' => env('SMS_DRIVER','plivo'),

    /**
     * Plivo settings
     */
    'plivo' => [
        'token' => env('PLIVO_AUTH_TOKEN'),
        'user'  => env('PLIVO_AUTH_ID'),
        'from'  => env('PLIVO_FROM',null), //Default from phone number
    ], 
];
