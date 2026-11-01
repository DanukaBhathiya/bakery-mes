<?php
// Start the session (safe to call more than once).
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect visitors who are not logged in.
function require_login(): void
{
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}
