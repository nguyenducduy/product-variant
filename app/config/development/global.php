<?php
/**
 * Global configuration.
 */
return [
    'profiler' => true,
    'version' => [
        'css' => 1,
        'js' =>1
    ],
    'baseUrl' => 'thoitrang.dev',
    'staticUrl' => 'thoitrang.dev/public',
    'prefix' => 'thoitrang_',
    'title' => 'Thoitrang - Development',
    'template' => [
        // Controller Scope => Template Name
        'Index' => 'Default',
        'Error' => 'Default',
        'Admin' => 'Default',
        'Site' => 'Default'
    ],
    'defaultLanguage' => 'en',
    'tinipng' => false,
    'tinipngKey' => 'g2TEDWMaD9hpyQvqQFoFqNUqfLB-Jkcf',
    'cookieEncryptionkey' => 'KkX+DVfEA>196yN',
    'cache' => [
        'lifetime' => 86400,
        'adapter' => 'File',
        'cacheDir' => ROOT_PATH . '/app/var/cache/data/'
    ],
    'logger' => [
        'enabled' => false,
        'path' => ROOT_PATH . '/app/var/logs/',
        'format' => '[%date%][%type%] %message%'
    ],
    'view' => [
        'compiledPath' => ROOT_PATH . '/app/var/cache/volt/',
        'compiledExtension' => '.php',
        'compiledSeparator' => '_',
        'compileAlways' => true
    ],
    'session' => [
        'adapter' => 'Files'
    ],
    'assets' => [
        'local' => 'assets/'
    ],
    'metadata' => [
        'adapter' => 'Memory',
        'metaDataDir' => ROOT_PATH . '/app/var/cache/metadata/'
    ],
    'annotations' => [
        'adapter' => 'Memory',
        'annotationsDir' => ROOT_PATH . '/app/var/cache/annotations/'
    ],
    'user' => [
        'directory' => '/avatar/',
        'minsize' => 1000,
        'maxsize' => 1000000,
        'mimes' => [
            'image/gif',
            'image/jpeg',
            'image/jpg',
            'image/png',
        ],
        'sanitize' => true
    ],
    'product' => [
        'directory' => '/product/',
        'minsize' => 1000,
        'maxsize' => 1000000,
        'mimes' => [
            'image/gif',
            'image/jpeg',
            'image/jpg',
            'image/png',
        ],
        'sanitize' => true,
        'isoverwrite' => false
    ]
];
