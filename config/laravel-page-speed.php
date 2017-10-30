<?php

return [
    // Set this field to false to disable the laravel page speed service.
    'enable' => env('LARAVEL_PAGE_SPEED_ENABLE', true),

    // You can use * as wildcard.
    'skip' => [
        '*.pdf', // Ignore all routes with final .pdf
        '*/downloads/*', // Ignore all routes that contain 'downloads'
        '_debugbar/*',
    ],
];
