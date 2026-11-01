<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$pageTitle = $pageTitle ?? 'Bakery MES';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header class="site-header">
    <div class="brand">
        <a href="orders.php">Bakery MES</a>
    </div>
    <?php if (!empty($_SESSION['user_id'])): ?>
        <nav class="site-nav">
            <a href="orders.php">Orders</a>
            <a href="add_order.php">Add order</a>
            <a href="ovens.php">Ovens</a>
            <span class="nav-user"><?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></span>
            <a href="logout.php">Logout</a>
        </nav>
    <?php endif; ?>
</header>
<main class="site-main">
