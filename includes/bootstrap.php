<?php

declare(strict_types=1);

session_start();

define('APP_NAME', 'iLadi Clinic');
define('BASE_URL', '/clinic_appointment_system');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/auth.php';

spl_autoload_register(static function (string $class): void {
    $path = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (is_file($path)) {
        require_once $path;
    }
});
