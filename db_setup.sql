-- Bakery MES - MariaDB setup
-- Import this file in phpMyAdmin (or: mysql -u root < db_setup.sql)

CREATE DATABASE IF NOT EXISTS bakery_mes
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE bakery_mes;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role VARCHAR(50) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  category VARCHAR(50) NOT NULL,
  unit_price DECIMAL(8,2) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE ovens (
  id INT AUTO_INCREMENT PRIMARY KEY,
  oven_number VARCHAR(20) NOT NULL,
  status VARCHAR(50) NOT NULL,
  temperature INT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE orders (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(100) NOT NULL,
  product_id INT NOT NULL,
  quantity INT NOT NULL,
  order_date DATE NOT NULL,
  user_id INT NOT NULL,
  CONSTRAINT fk_orders_product
    FOREIGN KEY (product_id) REFERENCES products(id),
  CONSTRAINT fk_orders_user
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB;

-- Login: username = baker , password = password
-- Hash created with PHP password_hash('password', PASSWORD_DEFAULT)
INSERT INTO users (username, password_hash, role) VALUES
('baker', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'baker');

INSERT INTO products (name, category, unit_price) VALUES
('Sourdough Loaf', 'Bread', 4.50),
('Chocolate Croissant', 'Pastry', 3.25),
('Blueberry Muffin', 'Cake', 2.75),
('Cinnamon Roll', 'Pastry', 3.00);

INSERT INTO ovens (oven_number, status, temperature) VALUES
('OV-01', 'Running', 220),
('OV-02', 'Idle', 0),
('OV-03', 'Running', 180);

INSERT INTO orders (customer_name, product_id, quantity, order_date, user_id) VALUES
('Amaya Perera', 1, 2, '2026-10-28', 1),
('Nimal Silva', 2, 6, '2026-10-29', 1),
('Sajani Fernando', 3, 12, '2026-10-30', 1);
