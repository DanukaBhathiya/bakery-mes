# Bakery MES

A small Manufacturing Execution System for a local bakery, built with **HTML, CSS, PHP, and MariaDB**.

Staff can log in, view customer orders, add new orders, and check oven status.

## Requirements covered

1. Four MariaDB tables (`users`, `products`, `ovens`, `orders`) with foreign keys
2. Orders list page using `SELECT` + `foreach`
3. Add-order form using a PDO prepared statement
4. Login with `password_hash()` / `password_verify()`
5. Protected pages (redirect to `login.php` if not logged in)
6. Shared `header.php` / `footer.php` and one `css/styles.css`
7. Logout that ends the session

## Setup

1. Install XAMPP, WAMP, or Laragon (Apache + PHP + MariaDB).
2. Copy this project into your web root (for example `htdocs/bakery-mes`).
3. Start Apache and MySQL/MariaDB.
4. In phpMyAdmin, import [`db_setup.sql`](db_setup.sql).
5. Open `http://localhost/bakery-mes/` in a browser.

If your database password is not empty, edit [`config/db.php`](config/db.php).

## Demo login

- **Username:** `baker`
- **Password:** `password`

The password is stored as a hash in the `users` table (never plain text).

## Project structure

```
config/db.php
includes/header.php
includes/footer.php
includes/auth.php
css/styles.css
db_setup.sql
index.php
login.php
logout.php
orders.php
add_order.php
ovens.php
```
