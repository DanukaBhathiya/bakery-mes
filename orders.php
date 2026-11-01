<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/db.php';

// SELECT query joins products and users so the list shows useful names.
$sql = 'SELECT o.id, o.customer_name, o.quantity, o.order_date,
               p.name AS product_name, u.username AS staff_name
        FROM orders o
        INNER JOIN products p ON o.product_id = p.id
        INNER JOIN users u ON o.user_id = u.id
        ORDER BY o.order_date DESC, o.id DESC';

$stmt = $pdo->query($sql);
$orders = $stmt->fetchAll();

$pageTitle = 'Orders | Bakery MES';
require_once __DIR__ . '/includes/header.php';
?>

<h1>Customer orders</h1>
<p class="lead">All bakery orders loaded from MariaDB with a SELECT query.</p>

<?php if (count($orders) === 0): ?>
    <p class="panel">No orders yet. <a href="add_order.php">Add the first order</a>.</p>
<?php else: ?>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Order date</th>
                <th>Staff</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo (int) $order['id']; ?></td>
                    <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                    <td><?php echo (int) $order['quantity']; ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($order['staff_name']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
