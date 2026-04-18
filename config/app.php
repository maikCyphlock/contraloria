<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => 'Contraloría Municipal del Municipio Páez',
        'env' => getenv('APP_ENV') ?: 'production',
        'debug' => getenv('APP_DEBUG') ?: false,
        'url' => getenv('APP_URL') ?: 'http://localhost',
    ],
    'database' => [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'port' => getenv('DB_PORT') ?: '3306',
        'database' => getenv('DB_DATABASE') ?: 'contraloria',
        'username' => getenv('DB_USERNAME') ?: 'root',
        'password' => getenv('DB_PASSWORD') ?: '',
    ],
];
