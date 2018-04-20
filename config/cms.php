<?php

return [
    'geocodes' => [
        'code' => false,
        'latitude' => false,
        'longitude' => false,
        'rajaongkir_id' => true,
    ],
    'menus' => [
        'accordion' => [
            'doku_myshortcart_payment_methods' => false,
            'products' => true,
        ],
    ],
    'pages' => [
        'postmetas' => [
            'template_options' => [
                'bank_accounts' => false,
                'cnr_cash' => false,
            ],
        ],
    ],
    'transactions' => [
        'status_options' => [
            'received' => false,
            'finished' => false,
            'returned' => false,
        ],
    ],
    'user_addresses' => true,
    'users' => [
        'store_id' => false,
        'balance' => true,
        'game_token' => true,
        'game_token_default' => 10,

        'role_default' => false,
        'user_socialites' => true,
    ],
];
