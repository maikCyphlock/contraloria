<?php
declare(strict_types=1);

// Configuración de la página
$pageTitle = 'Contraloría Municipal del Municipio Páez – Estado Portuguesa';
$pageDescription = 'Sistema de la Contraloría Municipal del Municipio Páez – Estado Portuguesa';
$assetsVersion = '1.0.0';

// Rutas de las vistas (centralizadas para fácil mantenimiento)
$viewsPath = __DIR__ . '/views';
$partialsPath = $viewsPath . '/partials';
$sectionsPath = $viewsPath . '/sections';

// Función helper para cargar vistas de forma segura
function requireView(string $path): void {
    if (file_exists($path)) {
        require $path;
    } else {
        error_log("Vista no encontrada: $path");
        echo "<!-- Vista no encontrada: $path -->";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= htmlspecialchars($pageDescription, ENT_QUOTES, 'UTF-8') ?>">
    <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
    
    <!-- Preconnect para mejorar rendimiento -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    
    <!-- Fuentes con display=swap para mejor rendimiento -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    
    <!-- CSS con versionamiento para cache busting -->
    <link rel="stylesheet" href="/assets/css/styles.css?v=<?= $assetsVersion ?>">
</head>
<body>
    <?php requireView($partialsPath . '/header.php'); ?>
    
    <main>
        <?php requireView($sectionsPath . '/hero.php'); ?>
        <?php requireView($sectionsPath . '/servicios.php'); ?>
        <?php requireView($sectionsPath . '/djp.php'); ?>
        <?php requireView($sectionsPath . '/faq.php'); ?>
        <?php requireView($sectionsPath . '/mision.php'); ?>
        <?php requireView($sectionsPath . '/participacion.php'); ?>
        <?php requireView($sectionsPath . '/noticias.php'); ?>
        <?php requireView($sectionsPath . '/redes.php'); ?>
        <?php requireView($sectionsPath . '/legal.php'); ?>
        <?php requireView($sectionsPath . '/contacto.php'); ?>
    </main>
    
    <?php requireView($partialsPath . '/footer.php'); ?>
    <?php requireView($partialsPath . '/scripts.php'); ?>
</body>
</html>
