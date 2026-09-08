CREATE DATABASE IF NOT EXISTS novashop;

USE novashop;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(50) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    old_price DECIMAL(10,2),
    icon VARCHAR(20),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT DEFAULT 1,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status VARCHAR(30) DEFAULT 'Pending',
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

INSERT INTO products
(name, category, price, old_price, icon, description)
VALUES

('Wireless Headphones','electronics',1999,2999,'🎧',
'High quality wireless headphones with clear sound.'),

('Smart Watch','electronics',2499,3999,'⌚',
'Smart watch with fitness and notification features.'),

('Premium Sneakers','fashion',1799,2499,'👟',
'Comfortable premium sneakers for everyday use.'),

('Classic Backpack','fashion',999,1499,'🎒',
'Stylish and durable backpack.'),

('Table Lamp','home',799,1199,'💡',
'Modern table lamp for your home or office.'),

('Coffee Maker','home',2999,4499,'☕',
'Easy-to-use coffee maker for your kitchen.'),

('Beauty Care Kit','beauty',1299,1899,'💄',
'Complete beauty care kit.'),

('Fitness Ball','sports',699,999,'⚽',
'Perfect fitness ball for home workouts.');