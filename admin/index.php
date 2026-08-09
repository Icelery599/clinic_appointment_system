<?php
use App\Services\DashboardService;
$pageTitle = 'Admin Dashboard'; include __DIR__ . '/../includes/header.php'; require_login('administrator');
$service = new DashboardService(); $summary = $service->adminSummary(); $monthly = $service->monthlyAppointments();
?>
<h1>Administrator Dashboard</h1><div class="row g-3 mb-4">
<?php foreach ($summary as $label=>$value): ?><div class="col-md-2"><div class="card stat"><div class="card-body"><small><?= e(ucfirst($label)) ?></small><h3><?= e((string)$value) ?></h3></div></div></div><?php endforeach; ?>
</div><canvas id="monthlyChart" data-labels='<?= e(json_encode(array_column($monthly, 'label'))) ?>' data-values='<?= e(json_encode(array_column($monthly, 'total'))) ?>'></canvas>
<?php include __DIR__ . '/../includes/footer.php'; ?>
