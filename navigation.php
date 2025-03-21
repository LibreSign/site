<?php

return [

    'User' => [
        'Installation' => [
            'type' => 'user',
            'root' => '/documentation/user/instalation',
            'children' => [
                'Submenu' => ['root' => '/documentation/user/submenu'],
            ],
        ], 
    ],
    'Developer' => [
        'Installation' => [
            'type' => 'user',
            'root' => '/documentation/developer/instalation',
            'children' => [
                'Using a Starter Template' => ['root' => '/documentation/developer/starter-templates'],
            ],
        ], 
    ],
    'Admin' => [
        'Installation' => [
            'type' => 'user',
            'root' => '/documentation/admin/instalation',
            'children' => [
                'Using a Starter Template' => ['root' => '/documentation/admin/starter-templates'],
            ],
        ], 
    ],
  
 
];
