<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    /*
    |--------------------------------------------------------------------------
    | WhatsApp
    |--------------------------------------------------------------------------
    |
    | Tautan saluran WhatsApp resmi MWCNU. Disimpan di sini supaya halaman
    | yang berbeda tidak memakai URL terpisah dan supaya mudah diganti.
    |
    */

    'whatsapp' => [
        'channel' => env('MWCNU_WHATSAPP_CHANNEL', 'https://whatsapp.com/channel/0029Vb95DHQ4NVio49ZRCH1y'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Maps
    |--------------------------------------------------------------------------
    |
    | Tautan lokasi sekretariat MWCNU Gumelar. Memakai short-link resmi dari
    | Google Maps supaya mudah diganti tanpa menyentuh kode tampilan.
    |
    */

    'maps' => [
        'sekretariat' => env('MWCNU_MAPS_URL', 'https://maps.app.goo.gl/3prE39RPGmEpfMni9?g_st=ac'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

];
