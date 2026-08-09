<?php $pageTitle = 'About iLadi Clinic'; include __DIR__ . '/includes/header.php'; ?>
<section class="hero p-5 rounded-4 text-white mb-4">
  <div class="row align-items-center">
    <div class="col-lg-8">
      <p class="text-uppercase fw-semibold mb-2">Patient-first care</p>
      <h1 class="display-6 fw-bold">Modern care teams, appointments, and records in one clinic system</h1>
      <p class="lead mb-0">iLadi Clinic helps patients book visits while administrators, receptionists, and doctors manage the full appointment lifecycle from one secure PHP dashboard.</p>
    </div>
  </div>
</section>
<div class="row g-4 mb-4">
  <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h5">Our Mission</h2><p class="text-muted mb-0">Deliver accessible, compassionate healthcare with reliable scheduling, clear records, and timely follow-up.</p></div></div></div>
  <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h5">Our Services</h2><p class="text-muted mb-0">General medicine, pediatrics, dental care, eye clinic, laboratory coordination, and pharmacy support.</p></div></div></div>
  <div class="col-md-4"><div class="card h-100"><div class="card-body"><h2 class="h5">Our Technology</h2><p class="text-muted mb-0">Built for the installed PHP <?= e(PHP_MAJOR_VERSION . '.' . PHP_MINOR_VERSION) ?> runtime with PDO, sessions, CSRF protection, and Bootstrap 5.</p></div></div></div>
</div>
<div class="card"><div class="card-body"><h2 class="h4">How this system stays relevant</h2><p class="text-muted mb-0">Public pages now point visitors to live PHP workflows instead of disconnected static prototypes, so booking, login, registration, and dashboards stay aligned with the active application.</p></div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
