<?php

return [
    'cache' => true,
    'currency' => [
        'symbol' => [
            'left' => [
                'default' => 'Rp',
            ]
        ],
    ],
    'database' => [
        'eloquent' => [
            'model' => [
                'per_page' => env('CMS_DATABASE_ELOQUENT_MODEL_PER_PAGE', 10),
            ],
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
    'theme' => [
        'frontend' => 'default',
    ],
    'transactions' => [
        'sender_id' => true,
        'sender' => [
            'store_id' => true,
        ],
        'status_options' => [
            'received' => false,
            'finished' => false,
            'returned' => false,
        ],
    ],
    'user_addresses' => true,
    'users' => [
        'store_id' => false,
        'balance' => false,
        'balance_default' => 0,
        'game_token' => false,

        'role_default' => false,
        'usermetas' => [
            'job' => false,
        ],
        'user_socialites' => true,
    ],
];
