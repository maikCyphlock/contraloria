<?php

declare(strict_types=1);

use Contraloria\Core\Router;

$router = new Router();

// Ruta principal - página estática
$router->get('/', fn() => require __DIR__ . '/../public/home.php');

// Rutas de usuarios (comentadas hasta que se configure la base de datos)
// use Contraloria\Features\Usuarios\Controllers\UsuarioController;
// $controller = new UsuarioController();
// $router->get('/usuarios', [$controller, 'index']);
// $router->post('/usuarios', [$controller, 'crear']);

return $router;
