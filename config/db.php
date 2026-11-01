<?php
// PDO connection to the MariaDB bakery_mes database.
// Change host/user/password if your local XAMPP/WAMP settings differ.

$host = '127.0.0.1';
$dbname = 'bakery_mes';
$user = 'root';
$password = ''; // default empty password on XAMPP

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('Database connection failed. Check config/db.php and that MariaDB is running.');
}
