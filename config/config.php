<?php

return [
    'site-name' => 'LaraMvcms',
    'auth' => [
        'password' => [
            'email' => 'lara-mvcms::emails.password',
            'table' => 'admin_password_resets',
            'expire' => 60,
        ],
    ],
    'defaults' => [
        'per-page' => 25
    ],
    'gallery' => [
        'image-sizes' => explode('|', env('GALLERY_SIZES', '200x200c|200x200b'))
    ]
];
