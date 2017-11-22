<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'imagick',

    'large_size' => 1024,
    'thumbnail_size' => 300,
    'watermark' => false,
    'watermark_image' => env('APP_URL').'/images/media/watermark.png', // width watermark == large_size
    'watermark_image_thumbnail' => env('APP_URL').'/images/media/watermark-thumbnail.png', // width watermark_thumbnail == thumbnail_size
];
