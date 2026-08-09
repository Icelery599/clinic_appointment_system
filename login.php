<?php
use App\Services\AuthService;
$pageTitle = 'Login'; include __DIR__ . '/includes/header.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    if ((new AuthService())->login(post('email'), post('password'))) {
        redirect(role_home(current_user()['role']));
    }
    flash('danger', 'Invalid email or password.');
    redirect('/login.php');
}
?>
<div class="auth-card mx-auto card"><div class="card-body"><h1 class="h3 mb-3">Login</h1><form method="post"><?= csrf_field() ?><input class="form-control mb-3" name="email" type="email" placeholder="Email" required><input class="form-control mb-3" name="password" type="password" placeholder="Password" required><button class="btn btn-primary w-100">Login</button></form><a href="forgot-password.php">Forgot password?</a></div></div>
<?php include __DIR__ . '/includes/footer.php'; ?>
