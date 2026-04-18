<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Contraloria\Core\Logger;

// Inicializar logger
Logger::init();

$router = require __DIR__ . '/../src/routes.php';
$router->dispatch();
