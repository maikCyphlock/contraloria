# Contraloría Municipal del Municipio Páez

Sistema de la Contraloría Municipal del Municipio Páez – Estado Portuguesa.

## Arquitectura

Proyecto PHP organizado por features con estructura simple y mantenible.

### Estructura de Carpetas

```
src/
├── Core/              # Clases compartidas (Router, Database, etc.)
└── Features/          # Módulos por funcionalidad
    └── Usuarios/
        ├── Controllers/  # Controladores
        ├── Models/       # Modelos/Entidades
        ├── Services/     # Lógica de negocio
        └── Views/        # Vistas
config/                 # Configuración
public/                 # Punto de entrada público
```

## Instalación

1. Instalar dependencias de PHP:
```bash
composer install
```

2. Instalar dependencias de desarrollo (opcional, para autoreload):
```bash
bun install
```

3. Configurar el servidor web para apuntar al directorio `public/`

## Desarrollo

### Requisitos
- PHP >= 8.1
- Composer
- Bun (opcional, para autoreload)

### Servidor de desarrollo

#### Opción 1: Servidor PHP básico
```bash
php -S localhost:8001 -t public
```

#### Opción 2: Con autoreload (BrowserSync + Bun)

Para desarrollo con recarga automática al guardar cambios:

1. Inicia el servidor PHP en una terminal:
```bash
php -S localhost:8001 -t public
```

2. Inicia BrowserSync en otra terminal:
```bash
bun run dev
```

3. Abre `http://localhost:3000` en tu navegador

BrowserSync detectará cambios en archivos PHP, CSS y JS y recargará automáticamente el navegador.

**Beneficios de usar BrowserSync:**
- Recarga automática al guardar cambios
- Sincronización entre múltiples navegadores
- UI de configuración en `http://localhost:3002`
- Proxy del servidor PHP en puerto 3000

## Logging

El proyecto usa Monolog para el registro de eventos y auditoría de seguridad.

### Uso del Logger

```php
use Contraloria\Core\Logger;

// Registrar información
Logger::info('Mensaje informativo', ['contexto' => 'valor']);

// Registrar advertencias
Logger::warning('Mensaje de advertencia', ['contexto' => 'valor']);

// Registrar errores
Logger::error('Mensaje de error', ['contexto' => 'valor']);

// Registrar eventos críticos
Logger::critical('Evento crítico', ['contexto' => 'valor']);

// Registrar eventos de seguridad
Logger::security('Intento de acceso no autorizado', ['ip' => '192.168.1.1']);

// Registrar auditoría de acciones
Logger::audit('LOGIN_EXITOSO', 'usuario@example.com', [
    'role' => 'admin',
    'location' => 'Acarigua'
]);
```

### Archivos de Log

Los logs se guardan en el directorio `logs/`:
- `app.log` - Todos los eventos (rotación diaria, mantiene 30 días)
- `error.log` - Solo errores críticos

**Nota:** El directorio `logs/` está en `.gitignore` para no subir logs al repositorio.
