<?php
// IMPORTANTE: Elimina este archivo después de usarlo
define('LARAVEL_START', microtime(true));
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo '<pre>';
echo "=== SETUP LARAVEL ===\n\n";

// Generar APP_KEY si está vacía
$key = env('APP_KEY');
if (empty($key)) {
    $kernel->call('key:generate');
    echo "✓ APP_KEY generada\n";
} else {
    echo "✓ APP_KEY ya existe\n";
}

// Ejecutar migraciones
echo "\n--- Ejecutando migraciones ---\n";
$kernel->call('migrate', ['--force' => true]);
echo $kernel->output();
echo "✓ Migraciones completadas\n";

// Limpiar caché
$kernel->call('config:clear');
$kernel->call('view:clear');
echo "✓ Caché limpiada\n";

echo "\n=== LISTO. Elimina este archivo ahora: public/setup.php ===";
echo '</pre>';
