CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_categories FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NULL UNIQUE,
    phone VARCHAR(20) NULL,
    address VARCHAR(200) NULL,
    number VARCHAR(10) NULL,
    complement VARCHAR(100) NULL,
    neighborhood VARCHAR(100) NULL,
    city VARCHAR(100) NULL,
    state CHAR(2) NULL,
    cep VARCHAR(9) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Pendente',
    payment_method VARCHAR(50) NULL,
    transaction_code VARCHAR(100) NULL,
    CONSTRAINT fk_orders_clients FOREIGN KEY (client_id) REFERENCES clients(id)
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_items_orders FOREIGN KEY (order_id) REFERENCES orders(id),
    CONSTRAINT fk_items_products FOREIGN KEY (product_id) REFERENCES products(id)
);

-- INSERTS BASE
INSERT INTO categories (id, name, description, active) VALUES 
(1, 'Eletrônicos', 'Dispositivos e acessórios de tecnologia', 1),
(2, 'Vestuário', 'Roupas e calçados para o dia a dia', 1),
(3, 'Casa & Decoração', 'Itens para deixar seu espaço confortável', 1);

INSERT INTO products (category_id, name, description, price, stock, image, active) VALUES 
(1, 'Fone de Ouvido Bluetooth', 'Fone de ouvido sem fio com cancelamento de ruído.', 199.90, 15, 'https://via.placeholder.com/300', 1),
(1, 'Smartwatch Esportivo', 'Relógio inteligente com medidor de frequência cardíaca.', 299.00, 8, 'https://via.placeholder.com/300', 1),
(2, 'Camiseta Algodão Premium', 'Camiseta 100% algodão super macia e confortável.', 59.90, 30, 'https://via.placeholder.com/300', 1),
(2, 'Tênis Casual Urbano', 'Tênis leve e resistente para uso diário.', 189.99, 12, 'https://via.placeholder.com/300', 1),
(3, 'Luminária de Mesa LED', 'Luminária com ajuste de brilho e luz fria/quente.', 89.90, 20, 'https://via.placeholder.com/300', 1);

-- ADM
INSERT INTO admins (name, email, password, active) VALUES ('Administrador', 'admin@loja.com', 'admin123', 1);
INSERT INTO admins (name, email, password, active) VALUES ('Administrador', 'lourenco@loja.com', 'admin123', 1);

-- CONSULTAS
SELECT * FROM clients;
SELECT * FROM categories;
SELECT * FROM products;
SELECT * FROM admins;