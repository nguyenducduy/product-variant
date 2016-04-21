<?php

/**
 * Access Controll List (ACL) Config Variable for Core Framework
 * @var array
 */
define('ROLE_GUEST', 1);
define('ROLE_ADMIN', 5);
define('ROLE_MOD', 10);
define('ROLE_MEMBER', 15);

return [
    ROLE_GUEST => [
        'Core' => [
            'error/*',
            'index/index'
        ],
        'User' => [
            'admin/login',
            'error/*'
        ],
        'Pcategory' => [
            'error/*'
        ],
        'Product' => [
            'error/*'
        ],
        'Home' => [
            'error/*',
            'site/*'
        ]
    ],

    ROLE_ADMIN => [
        'User' => [
            'error/*',
            'admin/*',
        ],
        'Core' => [
            'error/*',
            'index/*'
        ],
        'Pcategory' => [
            'error/*',
            'admin/*'
        ],
        'Product' => [
            'error/*',
            'admin/*'
        ],
        'Slug' => [
            'error/*',
            'admin/*',
        ],
        'Home' => [
            'error/*',
            'admin/*',
            'site/*',
        ]
    ],

    ROLE_MOD => [
        'User' => [
            'admin/*',
        ],
        'Core' => [
            'error/*',
            'index/index'
        ]
    ],

    ROLE_MEMBER => [
        'User' => [
            'admin/*',
        ],
        'Core' => [
            'error/*',
            'index/index'
        ]
    ]
];
