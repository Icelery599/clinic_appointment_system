<?php

declare(strict_types=1);

namespace App\Services;

use Database;

final class AuthService
{
    public function login(string $email, string $password): bool
    {
        $stmt = Database::connection()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if (!$user || !password_verify($password, $user['password'])) {
            return false;
        }
        $_SESSION['user'] = ['id' => $user['id'], 'name' => $user['name'], 'email' => $user['email'], 'role' => $user['role']];
        return true;
    }

    public function registerPatient(array $data): void
    {
        $pdo = Database::connection();
        $pdo->beginTransaction();
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, "patient")');
        $stmt->execute([$data['fullname'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT)]);
        $userId = (int)$pdo->lastInsertId();
        $stmt = $pdo->prepare('INSERT INTO patients (user_id, fullname, gender, dob, phone, address, blood_group) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$userId, $data['fullname'], $data['gender'], $data['dob'], $data['phone'], $data['address'], $data['blood_group']]);
        $pdo->commit();
    }
}
