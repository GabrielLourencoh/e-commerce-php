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
                $sql = "INSERT INTO products (category_id, name, description, price, stock, active) 
                        VALUES (:category_id, :name, :description, :price, :stock, :active)";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':category_id', $product->getCategoryId());
                $stmt->bindValue(':name', $product->getName());
                $stmt->bindValue(':description', $product->getDescription());
                $stmt->bindValue(':price', $product->getPrice());
                $stmt->bindValue(':stock', $product->getStock());
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
                            price = :price, stock = :stock, active = :active 
                        WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':category_id', $product->getCategoryId());
                $stmt->bindValue(':name', $product->getName());
                $stmt->bindValue(':description', $product->getDescription());
                $stmt->bindValue(':price', $product->getPrice());
                $stmt->bindValue(':stock', $product->getStock());
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
                $sql = "DELETE FROM products WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->execute();

                if ($stmt->rowCount() == 0) {
                    return "Erro ao excluir o produto!";
                }

                return "sucesso";
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    return "Não é possível excluir este produto pois ele possui vendas/pedidos vinculados!";
                }
                return "Erro no banco de dados: " . $e->getMessage();
            }
        }
    }
?>