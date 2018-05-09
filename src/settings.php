<?php
return [
    'settings' => [
        'displayErrorDetails' => true,      // set to false in production
        'addContentLengthHeader' => false,  // Allow the web server to send the content-length header
         // Only set this if you need access to route within middleware
         'determineRouteBeforeAppMiddleware' => true,
         
        // Database
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'lorjula',
            'username' => 'root',
            'password' => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],
        'dbdev' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'lorjula',
            'username' => 'root',
            'password' => 'password',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ],

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // cache
        'cache' => [
            'cache_path' => __DIR__ . '/../path/to/cache/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'lorjula',
            'path' => __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

    ],
];
