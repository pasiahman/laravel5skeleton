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

        'role_default' => false,
    ],
];
