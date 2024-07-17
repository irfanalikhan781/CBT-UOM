<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],



    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'candidate' => [
            'driver' => 'session',
            'provider' => 'candidates',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

    ],


    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'super_admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\SuperAdmin::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
        'candidates' => [
            'driver' => 'eloquent',
            'model' => App\Models\Candidate::class,
        ],

    ],

    'passwords' => [
        'candidates' => [
            'provider' => 'candidates',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ]
    ],

    'password_timeout' => 10800,

];
