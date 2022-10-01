<?php

return array(
    "payment" => [
        "fee" => [
            "account" => env('OXO_FEE_ACCOUNT',NULL),
        ]
    ],

    "networks"      => [
        [
            'chain' => 'eth',
            'name' => 'Ethereum',
            'nativeCurrency' => ['ETH'],
            'deposit' => ['ETH'],
            'enabled' => true,
        ],
        [
            'chain' => 'bnb',
            'name' => 'Binance Smart Chain',
            'nativeCurrency' => ['BNB'],
            'deposit' => ['BNB'],
            'enabled' => true,
        ],
        [
            'chain' => 'MATIC',
            'name' => 'Matic',
            'nativeCurrency' => ['Matic'],
            'deposit' => ['Matic'],
            'enabled' => true,
        ],
        [
            'chain' => NULL,
            'name' => 'Stable Coins',
            'nativeCurrency' => ['USD','EUR','GBP'],
            'deposit' => ['USD','EUR','GBP'],
            'enabled' => true,
        ],
    ],

    'homepage' => [
        'auth' => 'company.pools',
        'guest' => 'home',
    ],

    'socials' => [
        'tg' => '/',
        'insta' => '/',
        'fb' => '/',
        'vk' => NULL,
        'youtube' => '/',
    ],


);
