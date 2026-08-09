<?php $pageTitle = 'Clinic Appointment System'; include __DIR__ . '/includes/header.php'; ?>
<section class="hero p-5 rounded-4 text-white mb-4">
  <div class="row align-items-center">
    <div class="col-lg-7">
      <h1 class="display-5 fw-bold">Modern clinic appointments built for PHP <?= e(PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION) ?> and MySQL</h1>
      <p class="lead">Book visits, manage doctors, approve appointments, record diagnoses, issue prescriptions, and report on clinic performance.</p>
      <a class="btn btn-light btn-lg" href="<?= BASE_URL ?>/register.php">Register as Patient</a>
      <a class="btn btn-outline-light btn-lg" href="<?= BASE_URL ?>/login.php">Staff Login</a>
      <a class="btn btn-outline-light btn-lg" href="<?= BASE_URL ?>/about.php">About the Clinic</a>
    </div>
  </div>
</section>
<div class="row g-3">
<?php foreach (['General Medicine','Pediatrics','Dental','Eye Clinic','Laboratory','Pharmacy'] as $dept): ?>
  <div class="col-md-4"><div class="card h-100"><div class="card-body"><h5><?= e($dept) ?></h5><p class="text-muted">Department scheduling, doctors, and appointment availability.</p></div></div></div>
<?php endforeach; ?>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
