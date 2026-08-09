<?php
use App\Services\AuthService;
$pageTitle = 'Patient Registration'; include __DIR__ . '/includes/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    (new AuthService())->registerPatient($_POST);
    flash('success', 'Registration successful. Please log in.');
    redirect('/login.php');
}
?>
<div class="card"><div class="card-body"><h1 class="h3">Patient Registration</h1><form method="post" class="row g-3"><?= csrf_field() ?>
<?php foreach ([['fullname','Full name'],['email','Email'],['phone','Phone'],['dob','Date of birth'],['blood_group','Blood group'],['address','Address']] as $f): ?>
<div class="col-md-6"><label class="form-label"><?= $f[1] ?></label><input class="form-control" name="<?= $f[0] ?>" <?= $f[0]==='email'?'type="email"':'' ?> required></div>
<?php endforeach; ?>
<div class="col-md-6"><label class="form-label">Gender</label><select class="form-select" name="gender"><option>Female</option><option>Male</option><option>Other</option></select></div>
<div class="col-md-6"><label class="form-label">Password</label><input class="form-control" name="password" type="password" required minlength="8"></div><div class="col-12"><button class="btn btn-primary">Create account</button></div></form></div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
