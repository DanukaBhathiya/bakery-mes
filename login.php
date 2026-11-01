<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

// Already logged in → go to orders.
if (!empty($_SESSION['user_id'])) {
    header('Location: orders.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Prepared statement looks up the user by username.
    $stmt = $pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = ? LIMIT 1');
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // password_verify checks the plain password against the stored hash.
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: orders.php');
        exit;
    }

    $error = 'Invalid username or password.';
}

$pageTitle = 'Login | Bakery MES';
require_once __DIR__ . '/includes/header.php';
?>

<section class="login-wrap panel">
    <h1>Staff login</h1>
    <p class="lead">Enter your bakery staff username and password.</p>

    <?php if ($error !== ''): ?>
        <div class="message message-error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" class="form-stack" action="login.php">
        <label>
            Username
            <input type="text" name="username" required autocomplete="username">
        </label>
        <label>
            Password
            <input type="password" name="password" required autocomplete="current-password">
        </label>
        <button type="submit">Log in</button>
    </form>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
