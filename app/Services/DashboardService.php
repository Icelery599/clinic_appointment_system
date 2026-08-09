<?php

declare(strict_types=1);

namespace App\Services;

use Database;

final class DashboardService
{
    public function adminSummary(): array
    {
        $pdo = Database::connection();
        return [
            'patients' => (int)$pdo->query('SELECT COUNT(*) FROM patients')->fetchColumn(),
            'doctors' => (int)$pdo->query('SELECT COUNT(*) FROM doctors')->fetchColumn(),
            'today' => (int)$pdo->query('SELECT COUNT(*) FROM appointments WHERE appointment_date = CURDATE()')->fetchColumn(),
            'pending' => (int)$pdo->query('SELECT COUNT(*) FROM appointments WHERE status = "Pending"')->fetchColumn(),
            'completed' => (int)$pdo->query('SELECT COUNT(*) FROM appointments WHERE status = "Completed"')->fetchColumn(),
            'revenue' => (float)$pdo->query('SELECT COALESCE(SUM(d.consultation_fee),0) FROM appointments a JOIN doctors d ON d.id=a.doctor_id WHERE a.status="Completed"')->fetchColumn(),
        ];
    }

    public function monthlyAppointments(): array
    {
        $stmt = Database::connection()->query('SELECT DATE_FORMAT(appointment_date, "%b") label, COUNT(*) total FROM appointments GROUP BY YEAR(appointment_date), MONTH(appointment_date) ORDER BY MIN(appointment_date) LIMIT 12');
        return $stmt->fetchAll();
    }
}
