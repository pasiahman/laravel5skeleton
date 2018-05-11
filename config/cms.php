<?php

return [
    'currency' => [
        'symbol' => [
            'left' => [
                'default' => 'Rp',
            ]
        ],
    ],
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
            'product_categories' => false,
            'product_testimonials' => false,
        ],
    ],
    'pages' => [
        'postmetas' => [
            'template_options' => [
                'bank_accounts' => false,
                'cnr_cash' => false,
                'home' => false,
                'new_arrival' => false,
            ],
        ],
    ],
    'products' => [
        'product_testimonials' => [
            'rating_average' => false,
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
        'usermetas' => [
            'job' => false,
        ],
        'user_socialites' => true,
    ],
];
