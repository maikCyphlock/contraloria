<?php

declare(strict_types=1);

namespace Contraloria\Core;

use Contraloria\Core\Logger;

class Router
{
    private array $routes = [];

    public function get(string $path, callable $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch(): void
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/';

        if (!isset($this->routes[$method][$path])) {
            Logger::warning('Ruta no encontrada', [
                'method' => $method,
                'path' => $path,
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
            ]);
            http_response_code(404);
            echo 'Página no encontrada';
            return;
        }

        try {
            Logger::info('Acceso a ruta', [
                'method' => $method,
                'path' => $path,
                'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
            ]);
            call_user_func($this->routes[$method][$path]);
        } catch (\Exception $e) {
            Logger::error('Error al procesar ruta', [
                'method' => $method,
                'path' => $path,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            http_response_code(500);
            echo 'Error interno del servidor';
        }
    }
}
