<?php

declare(strict_types=1);

namespace Contraloria\Core;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;

class Logger
{
    private static ?MonologLogger $instance = null;
    private static string $logPath;

    public static function init(string $logPath = __DIR__ . '/../../logs'): void
    {
        self::$logPath = $logPath;
        
        // Crear directorio de logs si no existe
        if (!is_dir($logPath)) {
            mkdir($logPath, 0755, true);
        }
    }

    public static function getInstance(string $channel = 'contraloria'): MonologLogger
    {
        if (self::$instance === null) {
            self::$instance = new MonologLogger($channel);
            
            // Handler para archivo con rotación diaria
            $fileHandler = new RotatingFileHandler(
                self::$logPath . '/app.log',
                30, // Mantener 30 días de logs
                Level::Debug
            );
            
            // Handler para errores críticos en archivo separado
            $errorHandler = new StreamHandler(
                self::$logPath . '/error.log',
                Level::Error
            );
            
            self::$instance->pushHandler($fileHandler);
            self::$instance->pushHandler($errorHandler);
        }

        return self::$instance;
    }

    public static function info(string $message, array $context = []): void
    {
        self::getInstance()->info($message, $context);
    }

    public static function warning(string $message, array $context = []): void
    {
        self::getInstance()->warning($message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        self::getInstance()->error($message, $context);
    }

    public static function critical(string $message, array $context = []): void
    {
        self::getInstance()->critical($message, $context);
    }

    public static function security(string $message, array $context = []): void
    {
        self::getInstance()->alert($message, $context);
    }

    public static function audit(string $action, string $user, array $details = []): void
    {
        self::getInstance()->info('AUDIT', [
            'action' => $action,
            'user' => $user,
            'details' => $details,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }
}
