<?php

return array(
    "payment" => [
        "fee" => [
            "account" => env('OXO_FEE_ACCOUNT',NULL),
        ]
    ],

    "networks"      => [
        [
            'chain' => 'ETH',
            'name' => 'Ethereum',
            'nativeCurrency' => ['ETH'],
            'deposit' => ['ETH','USDT'],
            'enabled' => true,
        ],
        [
            'chain' => 'BSC',
            'name' => 'Binance Smart Chain',
            'nativeCurrency' => ['BNB'],
            'deposit' => ['BNB','USDT'],
            'enabled' => true,
        ],
        [
            'chain' => 'Matic',
            'name' => 'Matic',
            'nativeCurrency' => ['Matic'],
            'deposit' => ['Matic'],
            'enabled' => true,
        ],
        [
            'chain' => 'USDX',
            'name' => 'Stable Coins',
            'nativeCurrency' => ['USDT','BUSD','USDC'],
            'deposit' => ['USDT','BUSD','USDC'],
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
