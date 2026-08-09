# Clinic Appointment System

A PHP 8.4+ MySQL clinic appointment management system for XAMPP. It includes role-based dashboards for administrators, doctors, receptionists, and patients, plus appointment booking, medical records, prescriptions, reports, CSRF protection, PDO prepared statements, and session-based access control.

## Stack

- Frontend: HTML5, CSS3, JavaScript, Bootstrap 5
- Backend: PHP 8.4+ (OOP, matching the installed local PHP runtime used for this project)
- Database: MySQL
- Server: XAMPP / Apache
- Version control: Git & GitHub

## Setup

1. Copy this folder into your XAMPP `htdocs` directory.
2. Create a MySQL database named `clinic_system`.
3. Import `database/schema.sql`.
4. Update database credentials in `config/database.php` if needed.
5. Start Apache and MySQL from XAMPP.
6. Confirm your CLI/runtime version with `php -v`; this project currently requires PHP 8.4 or newer via `composer.json`.
7. Open `http://localhost/clinic_appointment_system/`.

## Demo accounts

The schema seeds these users with password `password`:

- Admin: `admin@clinic.test`
- Doctor: `doctor@clinic.test`
- Receptionist: `reception@clinic.test`
- Patient: `patient@clinic.test`

## Key folders

- `admin/`, `doctor/`, `patient/`, `receptionist/`: role dashboards and workflows
- `app/`: OOP service classes and models
- `config/`: database and application settings
- `database/`: MySQL schema and seed data
- `includes/`: shared layout, authentication, CSRF, and helper functions
- `assets/`: Bootstrap-based custom CSS and JavaScript
