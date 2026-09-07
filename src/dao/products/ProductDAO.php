<?php

    require_once __DIR__ . '/../../../config/Connection.php';
    require_once __DIR__ . '/../../models/products/Product.php';

    class ProductDAO {
        private $conn;

        public function __construct() {
            $database = new Connection();
            $this->conn = $database->connect();
        }

        public function getProducts() {
            $sql = "SELECT p.*, c.name AS category_name 
                    FROM products p 
                    INNER JOIN categories c ON p.category_id = c.id 
                    WHERE p.active = 1
                    ORDER BY p.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getAllProducts() {
            $sql = "SELECT p.*, c.name AS category_name 
                    FROM products p 
                    INNER JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getById($id) {
            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function insert(Product $product) {
            try {
                $sql = "INSERT INTO products (category_id, name, description, price, stock, image, active) 
                        VALUES (:category_id, :name, :description, :price, :stock, :image, :active)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':category_id', $product->getCategoryId());
                $stmt->bindValue(':name', $product->getName());
                $stmt->bindValue(':description', $product->getDescription());
                $stmt->bindValue(':price', $product->getPrice());
                $stmt->bindValue(':stock', $product->getStock());
                $stmt->bindValue(':image', $product->getImage());
                $stmt->bindValue(':active', $product->getActive());
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    return "Erro ao cadastrar produto!";
                }

                return "sucesso";
            } catch (PDOException $e) {
                return "Erro no banco de dados: " . $e->getMessage();
            }
        }

        public function update(Product $product) {
            try {
                $sql = "UPDATE products 
                        SET category_id = :category_id, name = :name, description = :description, 
                            price = :price, stock = :stock, image = :image, active = :active 
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':category_id', $product->getCategoryId());
                $stmt->bindValue(':name', $product->getName());
                $stmt->bindValue(':description', $product->getDescription());
                $stmt->bindValue(':price', $product->getPrice());
                $stmt->bindValue(':stock', $product->getStock());
                $stmt->bindValue(':image', $product->getImage());
                $stmt->bindValue(':active', $product->getActive());
                $stmt->bindValue(':id', $product->getId());
                $stmt->execute();

                return "sucesso";
            } catch (PDOException $e) {
                return "Erro no banco de dados: " . $e->getMessage();
            }
        }

        public function delete($id) {
            try {
                $sqlCheck = "SELECT COUNT(*) as total FROM order_items WHERE product_id = :id";
                $stmtCheck = $this->conn->prepare($sqlCheck);
                $stmtCheck->bindValue(':id', $id);
                $stmtCheck->execute();
                $count = $stmtCheck->fetch(PDO::FETCH_ASSOC)['total'];

                if ($count > 0) {
                    return "Não é possível excluir este produto pois ele possui {$count} venda(s) vinculada(s)!";
                }

                $sql = "UPDATE products SET active = 0 WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    return "Produto não encontrado!";
                }

                return "sucesso";
            } catch (PDOException $e) {
                return "Erro no banco de dados: " . $e->getMessage();
            }
        }
    }
?>