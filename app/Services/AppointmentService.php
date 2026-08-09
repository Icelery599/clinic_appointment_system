<?php

declare(strict_types=1);

namespace App\Services;

use Database;

final class AppointmentService
{
    public function book(array $data): void
    {
        $stmt = Database::connection()->prepare('INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status, reason) VALUES (?, ?, ?, ?, "Pending", ?)');
        $stmt->execute([$data['patient_id'], $data['doctor_id'], $data['appointment_date'], $data['appointment_time'], $data['reason']]);
    }

    public function updateStatus(int $id, string $status): void
    {
        $allowed = ['Pending', 'Approved', 'Completed', 'Cancelled', 'Missed'];
        if (!in_array($status, $allowed, true)) {
            throw new \InvalidArgumentException('Invalid appointment status.');
        }
        $stmt = Database::connection()->prepare('UPDATE appointments SET status = ? WHERE id = ?');
        $stmt->execute([$status, $id]);
    }

    public function listForRole(array $user): array
    {
        $pdo = Database::connection();
        if ($user['role'] === 'doctor') {
            $stmt = $pdo->prepare('SELECT a.*, p.fullname patient_name FROM appointments a JOIN patients p ON p.id=a.patient_id JOIN doctors d ON d.id=a.doctor_id WHERE d.user_id=? ORDER BY a.appointment_date DESC, a.appointment_time DESC');
            $stmt->execute([$user['id']]);
            return $stmt->fetchAll();
        }
        if ($user['role'] === 'patient') {
            $stmt = $pdo->prepare('SELECT a.*, u.name doctor_name FROM appointments a JOIN doctors d ON d.id=a.doctor_id JOIN users u ON u.id=d.user_id JOIN patients p ON p.id=a.patient_id WHERE p.user_id=? ORDER BY a.appointment_date DESC, a.appointment_time DESC');
            $stmt->execute([$user['id']]);
            return $stmt->fetchAll();
        }
        return $pdo->query('SELECT a.*, p.fullname patient_name, u.name doctor_name FROM appointments a JOIN patients p ON p.id=a.patient_id JOIN doctors d ON d.id=a.doctor_id JOIN users u ON u.id=d.user_id ORDER BY a.appointment_date DESC, a.appointment_time DESC')->fetchAll();
    }
}
