<?php

declare(strict_types=1);

namespace Contraloria\Core;

class Database
{
    private static ?\PDO $connection = null;

    public static function getConnection(): \PDO
    {
        if (self::$connection === null) {
            $config = require __DIR__ . '/../../config/app.php';
            
            self::$connection = new \PDO(
                "mysql:host={$config['database']['host']};dbname={$config['database']['database']};port={$config['database']['port']}",
                $config['database']['username'],
                $config['database']['password'],
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$connection;
    }
}
