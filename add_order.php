<?php
require_once __DIR__ . '/includes/auth.php';
require_login();
require_once __DIR__ . '/config/db.php';

// Product list for the dropdown (from the database, not a hard-coded array of orders).
$products = $pdo->query('SELECT id, name FROM products ORDER BY name')->fetchAll();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = trim($_POST['customer_name'] ?? '');
    $productId = (int) ($_POST['product_id'] ?? 0);
    $quantity = (int) ($_POST['quantity'] ?? 0);
    $orderDate = $_POST['order_date'] ?? '';
    $userId = (int) $_SESSION['user_id'];

    if ($customerName === '' || $productId < 1 || $quantity < 1 || $orderDate === '') {
        $error = 'Please fill in all fields with valid values.';
    } else {
        // PDO prepared statement inserts a new order row safely.
        $sql = 'INSERT INTO orders (customer_name, product_id, quantity, order_date, user_id)
                VALUES (?, ?, ?, ?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$customerName, $productId, $quantity, $orderDate, $userId]);
        $success = 'Order saved successfully.';
    }
}

$pageTitle = 'Add order | Bakery MES';
require_once __DIR__ . '/includes/header.php';
?>

<h1>Add order</h1>
<p class="lead">Record a new custom bakery order. Data is saved with a prepared statement.</p>

<?php if ($error !== ''): ?>
    <div class="message message-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if ($success !== ''): ?>
    <div class="message message-success">
        <?php echo htmlspecialchars($success); ?>
        <a href="orders.php">View orders</a>
    </div>
<?php endif; ?>

<form method="post" action="add_order.php" class="panel form-stack">
    <label>
        Customer name
        <input type="text" name="customer_name" required>
    </label>

    <label>
        Product
        <select name="product_id" required>
            <option value="">Select a product</option>
            <?php foreach ($products as $product): ?>
                <option value="<?php echo (int) $product['id']; ?>">
                    <?php echo htmlspecialchars($product['name']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Quantity
        <input type="number" name="quantity" min="1" required>
    </label>

    <label>
        Order date
        <input type="date" name="order_date" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>" required>
    </label>

    <button type="submit">Save order</button>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
