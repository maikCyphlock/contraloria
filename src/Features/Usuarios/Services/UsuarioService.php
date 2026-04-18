<?php

declare(strict_types=1);

namespace Contraloria\Features\Usuarios\Services;

use Contraloria\Core\Database;
use Contraloria\Features\Usuarios\Models\Usuario;

class UsuarioService
{
    private \PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function crear(string $nombre, string $email, string $password): Usuario
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, email, password) VALUES (:nombre, :email, :password)"
        );
        $stmt->execute([
            'nombre' => $nombre,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        $usuario = new Usuario(
            (int) $this->db->lastInsertId(),
            $nombre,
            $email,
            $hashedPassword
        );

        return $usuario;
    }

    public function buscarPorId(int $id): ?Usuario
    {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new Usuario(
            $data['id'],
            $data['nombre'],
            $data['email'],
            $data['password']
        );
    }

    public function listarTodos(): array
    {
        $stmt = $this->db->query("SELECT * FROM usuarios");
        $usuarios = [];

        while ($data = $stmt->fetch()) {
            $usuarios[] = new Usuario(
                $data['id'],
                $data['nombre'],
                $data['email'],
                $data['password']
            );
        }

        return $usuarios;
    }
}
