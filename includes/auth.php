<?php

declare(strict_types=1);

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function require_login(?string $role = null): void
{
    $user = current_user();
    if (!$user) {
        redirect('/login.php');
    }
    if ($role !== null && $user['role'] !== $role) {
        http_response_code(403);
        exit('Access denied.');
    }
}

function role_home(string $role): string
{
    return match ($role) {
        'administrator' => '/admin/index.php',
        'doctor' => '/doctor/index.php',
        'receptionist' => '/receptionist/index.php',
        default => '/patient/index.php',
    };
}
