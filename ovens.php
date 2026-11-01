<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/db.php';

// Read-only list of oven operational status and temperature.
$stmt = $pdo->query('SELECT id, oven_number, status, temperature FROM ovens ORDER BY oven_number');
$ovens = $stmt->fetchAll();

$pageTitle = 'Ovens | Bakery MES';
require_once __DIR__ . '/includes/header.php';
?>

<h1>Oven status</h1>
<p class="lead">Current oven operational status and temperature from MariaDB.</p>

<table class="data-table">
    <thead>
        <tr>
            <th>Oven</th>
            <th>Status</th>
            <th>Temperature (°C)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ovens as $oven): ?>
            <tr>
                <td><?php echo htmlspecialchars($oven['oven_number']); ?></td>
                <td><span class="status-pill"><?php echo htmlspecialchars($oven['status']); ?></span></td>
                <td><?php echo (int) $oven['temperature']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
