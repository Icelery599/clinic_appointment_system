<?php
use App\Services\AppointmentService;
$pageTitle='Manage Appointments'; include __DIR__.'/../includes/header.php'; require_login('administrator'); $svc=new AppointmentService();
if ($_SERVER['REQUEST_METHOD']==='POST') { verify_csrf(); $svc->updateStatus((int)post('id'), post('status')); flash('success','Appointment updated.'); redirect('/admin/appointments.php'); }
$appointments=$svc->listForRole(current_user()); include __DIR__.'/../includes/appointments-table.php'; include __DIR__.'/../includes/footer.php';
