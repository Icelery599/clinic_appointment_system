<?php

declare(strict_types=1);

session_start();

define('APP_NAME', 'iLadi Clinic');

$configuredBaseUrl = getenv('APP_BASE_URL');
if ($configuredBaseUrl !== false && trim($configuredBaseUrl) !== '') {
    $baseUrl = '/' . trim($configuredBaseUrl, '/');
} else {
    $projectRoot = realpath(__DIR__ . '/..');
    $documentRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath((string)$_SERVER['DOCUMENT_ROOT']) : false;

    if ($projectRoot !== false && $documentRoot !== false && str_starts_with($projectRoot, $documentRoot)) {
        $baseUrl = str_replace(DIRECTORY_SEPARATOR, '/', substr($projectRoot, strlen($documentRoot)));
    } else {
        $baseUrl = rtrim(str_replace('\\', '/', dirname((string)($_SERVER['SCRIPT_NAME'] ?? ''))), '/');
    }
}

$baseUrl = '/' . trim($baseUrl, '/');
define('BASE_URL', $baseUrl === '/' ? '' : $baseUrl);

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
