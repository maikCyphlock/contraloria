<?php

declare(strict_types=1);

namespace Contraloria\Features\Usuarios\Controllers;

use Contraloria\Features\Usuarios\Services\UsuarioService;

class UsuarioController
{
    private UsuarioService $service;

    public function __construct()
    {
        $this->service = new UsuarioService();
    }

    public function index(): void
    {
        $usuarios = $this->service->listarTodos();
        
        echo json_encode(array_map(fn($u) => [
            'id' => $u->getId(),
            'nombre' => $u->getNombre(),
            'email' => $u->getEmail(),
        ], $usuarios));
    }

    public function crear(): void
    {
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($nombre) || empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['error' => 'Todos los campos son obligatorios']);
            return;
        }

        $usuario = $this->service->crear($nombre, $email, $password);

        echo json_encode([
            'id' => $usuario->getId(),
            'nombre' => $usuario->getNombre(),
            'email' => $usuario->getEmail(),
        ]);
    }
}
