<?php

require_once __DIR__ . '/../../../config/Connection.php';
require_once __DIR__ . '/../../models/categories/Category.php';

class CategoryDAO {

    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    public function getCategories() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByName($name) {
        $sql = "SELECT * FROM categories WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(Category $category) {
        if ($this->getByName($category->getName())) {
            return "Esta categoria já está cadastrada!";
        }

        $sql = "INSERT INTO categories (name, description, active) VALUES (:name, :description, :active)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $category->getName());
        $stmt->bindValue(':description', $category->getDescription());
        $stmt->bindValue(':active', $category->getActive());
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return "Erro ao cadastrar categoria!";
        }

        return "sucesso";
    }

    public function update(Category $category) {
        $sql = "UPDATE categories SET name = :name, description = :description, active = :active WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $category->getName());
        $stmt->bindValue(':description', $category->getDescription());
        $stmt->bindValue(':active', $category->getActive());
        $stmt->bindValue(':id', $category->getId());
        $stmt->execute();

        return "sucesso";
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return "Erro ao excluir a categoria!";
            }

            return "sucesso";
        } catch (PDOException $e) {
            // Codigo vindo do erro -> 23000 indica erro de restrição de chave estrangeira
            if ($e->getCode() == '23000') {
                return "Não é possível excluir esta categoria pois existem produtos associados a ela!";
            }
            return "Erro no banco de dados: ".$e->getMessage();
        }
    }
}

?>