<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'mailgun'  => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses'      => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe'   => [
        'model'  => Tesis\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'facebook' => [
        'client_id'     => '127614600923757',
        'client_secret' => '078d399f5a2ce32742f2cdf3c387870d',
        'redirect'      => 'http://tesis.app/fblogin',
    ],
];
