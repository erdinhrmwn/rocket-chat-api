<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Rocket Chat instance URL
    |--------------------------------------------------------------------------
    |
    */

    'instance' => env('RC_INSTANCE'),

    /*
    |--------------------------------------------------------------------------
    | Rest api root
    |--------------------------------------------------------------------------
    |
    */

    'api_root' => env('RC_API_ROOT', '/api/v1/'),

    /*
    |--------------------------------------------------------------------------
    | Admin username
    |--------------------------------------------------------------------------
    |
    */

    'admin_username' => env('RC_ADMIN_USERNAME', 'admin'),

    /*
    |--------------------------------------------------------------------------
    | Admin password
    |--------------------------------------------------------------------------
    |
    */

    'admin_password' => env('RC_ADMIN_PASSWORD', ''),
];
