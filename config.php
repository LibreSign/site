<?php

return [
    'production' => getenv('APP_ENV') === 'production',
    'baseUrl' => '',
    'title' => 'LibreSign - Electronic signature of digital documents',
    'description' => 'Electronic signature of digital documents',
    'collections' => [
        'redirect' => [
            'extends' => '_layouts.redirect301',
            'path' => function($page) {
                return $page->from;
            },
            'items' => [
                [
                    'from' => '/teste',
                    'to' => '/',
                ],
                [
                    'from' => '/teste2',
                    'to' => '/',
                ],
            ],
        ]
    ],
];
