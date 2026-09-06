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
    phone VARCHAR(15) NULL,
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

-- INSERTS
INSERT INTO categories (id, name, description, active) VALUES 
(1, 'Eletrônicos', 'Dispositivos e acessórios de tecnologia', 1),
(2, 'Vestuário', 'Roupas e calçados para o dia a dia', 1),
(3, 'Casa & Decoração', 'Itens para deixar seu espaço confortável', 1),
(4, 'Esportes', 'Equipamentos e acessórios para atividades físicas', 1),
(5, 'Beleza', 'Cosméticos, perfumes e cuidados pessoais', 1),
(6, 'Livros', 'Livros físicos e digitais de diversos gêneros', 1),
(7, 'Brinquedos', 'Jogos e brinquedos para todas as idades', 1),
(8, 'Automotivo', 'Acessórios e peças para veículos', 1),
(9, 'Pet Shop', 'Produtos para animais de estimação', 1),
(10, 'Informática', 'Hardware, periféricos e componentes', 1);

INSERT INTO products (category_id, name, description, price, stock, image, active) VALUES 
(1, 'Fone de Ouvido Bluetooth', 'Fone de ouvido sem fio com cancelamento de ruído.', 199.90, 15, 'https://via.placeholder.com/300', 1),
(1, 'Smartwatch Esportivo', 'Relógio inteligente com medidor de frequência cardíaca.', 299.00, 8, 'https://via.placeholder.com/300', 1),
(2, 'Camiseta Algodão Premium', 'Camiseta 100% algodão super macia e confortável.', 59.90, 30, 'https://via.placeholder.com/300', 1),
(2, 'Tênis Casual Urbano', 'Tênis leve e resistente para uso diário.', 189.99, 12, 'https://via.placeholder.com/300', 1),
(3, 'Luminária de Mesa LED', 'Luminária com ajuste de brilho e luz fria/quente.', 89.90, 20, 'https://via.placeholder.com/300', 1),
(4, 'Bola de Futebol Oficial', 'Bola de futebol tamanho 5, aprovada pela FIFA.', 129.90, 25, 'https://via.placeholder.com/300', 1),
(5, 'Perfume Amadeirado 100ml', 'Fragrância masculina amadeirada de longa duração.', 249.90, 10, 'https://via.placeholder.com/300', 1),
(6, 'Livro: Clean Code', 'Guia de boas práticas de programação por Robert Martin.', 89.90, 50, 'https://via.placeholder.com/300', 1),
(7, 'Lego Classic 500 peças', 'Kit de blocos de montar criativo para crianças.', 199.90, 18, 'https://via.placeholder.com/300', 1),
(8, 'Carregador Veicular 30W', 'Carregador rápido USB-C para carro.', 79.90, 35, 'https://via.placeholder.com/300', 1),
(9, 'Ração Premium Cães 10kg', 'Ração super premium para cães adultos.', 159.90, 22, 'https://via.placeholder.com/300', 1),
(10, 'Teclado Mecânico RGB', 'Teclado gamer com switches blue e iluminação RGB.', 349.90, 7, 'https://via.placeholder.com/300', 1),
(3, 'Jogo de Panelas Antiaderente', 'Conjunto 5 peças com revestimento cerâmico.', 219.90, 14, 'https://via.placeholder.com/300', 1),
(4, 'Esteira Elétrica Residencial', 'Esteira dobrável com inclinação automática.', 1899.00, 3, 'https://via.placeholder.com/300', 1),
(5, 'Kit Skincare Completo', 'Limpeza, tônico, sérum e hidratante facial.', 179.90, 16, 'https://via.placeholder.com/300', 1),
(6, 'Kindle Paperwhite 16GB', 'Leitor digital com tela 6.8" e luz ajustável.', 549.90, 9, 'https://via.placeholder.com/300', 1),
(7, 'Boneca Articulada Fashion', 'Boneca com roupas e acessórios intercambiáveis.', 89.90, 28, 'https://via.placeholder.com/300', 1),
(8, 'Câmera de Ré Automotiva', 'Câmera noturna com guias de estacionamento.', 129.90, 20, 'https://via.placeholder.com/300', 1),
(9, 'Arranhador para Gatos Grande', 'Arranhador com toca e plataformas.', 149.90, 11, 'https://via.placeholder.com/300', 1),
(10, 'Monitor Gamer 27" 144Hz', 'Monitor IPS 1ms FreeSync/G-Sync.', 899.90, 6, 'https://via.placeholder.com/300', 1);

INSERT INTO clients (name, email, password, cpf, phone, address, number, complement, neighborhood, city, state, cep) VALUES 
('João Silva', 'joao@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '123.456.789-00', '(11) 99999-8888', 'Rua das Flores', '123', 'Apto 45', 'Centro', 'São Paulo', 'SP', '01000-000'),
('Maria Santos', 'maria@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '234.567.890-11', '(11) 98888-7777', 'Av. Paulista', '1000', '', 'Bela Vista', 'São Paulo', 'SP', '01310-100'),
('Pedro Oliveira', 'pedro@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '345.678.901-22', '(21) 97777-6666', 'Rua do Catete', '50', 'Casa', 'Catete', 'Rio de Janeiro', 'RJ', '22220-000'),
('Ana Costa', 'ana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '456.789.012-33', '(31) 96666-5555', 'Av. Afonso Pena', '800', 'Bloco B', 'Centro', 'Belo Horizonte', 'MG', '30130-000'),
('Carlos Ferreira', 'carlos@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '567.890.123-44', '(41) 95555-4444', 'Rua XV de Novembro', '200', '', 'Centro', 'Curitiba', 'PR', '80020-310'),
('Juliana Lima', 'juliana@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '678.901.234-55', '(51) 94444-3333', 'Av. Borges de Medeiros', '400', 'Sala 10', 'Centro Histórico', 'Porto Alegre', 'RS', '90020-020'),
('Roberto Alves', 'roberto@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '789.012.345-66', '(61) 93333-2222', 'SHS Quadra 6', 'Bloco C', '', 'Asa Sul', 'Brasília', 'DF', '70316-906'),
('Fernanda Rocha', 'fernanda@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '890.123.456-77', '(71) 92222-1111', 'Av. Sete de Setembro', '1500', 'Apto 201', 'Barra', 'Salvador', 'BA', '40060-001'),
('Lucas Martins', 'lucas@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '901.234.567-88', '(81) 91111-0000', 'Rua do Futuro', '300', '', 'Boa Viagem', 'Recife', 'PE', '51020-000'),
('Patrícia Gomes', 'patricia@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '012.345.678-99', '(85) 90000-9999', 'Av. Beira Mar', '2500', 'Cobertura', 'Meireles', 'Fortaleza', 'CE', '60165-121');

INSERT INTO admins (name, email, password, active) VALUES ('Administrador', 'admin@loja.com', 'admin123', 1),
('Administrador', 'lourenco@loja.com', 'admin123', 1);

INSERT INTO orders (client_id, order_date, total_amount, status, payment_method, transaction_code) VALUES 
(1, '2024-01-15 10:30:00', 489.80, 'Entregue', 'Cartão de Crédito', 'TXN001'),
(2, '2024-01-16 14:20:00', 299.00, 'Entregue', 'Pix', 'TXN002'),
(3, '2024-01-17 09:15:00', 189.99, 'Enviado', 'Boleto', 'TXN003'),
(4, '2024-01-18 16:45:00', 379.80, 'Pago', 'Cartão de Crédito', 'TXN004'),
(5, '2024-01-19 11:00:00', 129.90, 'Processando', 'Pix', 'TXN005'),
(6, '2024-01-20 13:30:00', 549.90, 'Pendente', 'Cartão de Crédito', 'TXN006'),
(7, '2024-01-21 10:00:00', 219.90, 'Cancelado', 'Boleto', 'TXN007'),
(8, '2024-01-22 15:20:00', 899.90, 'Entregue', 'Pix', 'TXN008'),
(9, '2024-01-23 08:45:00', 149.90, 'Enviado', 'Cartão de Crédito', 'TXN009'),
(10, '2024-01-24 12:10:00', 349.90, 'Pago', 'Pix', 'TXN010');

INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal) VALUES 
(1, 1, 1, 199.90, 199.90),
(1, 3, 1, 59.90, 59.90),
(1, 5, 1, 89.90, 89.90),
(1, 6, 1, 129.90, 129.90),
(2, 2, 1, 299.00, 299.00),
(3, 4, 1, 189.99, 189.99),
(4, 7, 1, 249.90, 249.90),
(4, 8, 1, 89.90, 89.90),
(5, 6, 1, 129.90, 129.90),
(6, 14, 1, 549.90, 549.90),
(7, 13, 1, 219.90, 219.90),
(8, 20, 1, 899.90, 899.90),
(9, 19, 1, 149.90, 149.90),
(10, 12, 1, 349.90, 349.90);