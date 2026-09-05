<?php
require_once __DIR__ . '/../../../config/Connection.php';

class OrderDAO {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    public function getAll() {
        $sql = "SELECT o.*, c.name AS client_name, c.email AS client_email 
                FROM orders o 
                INNER JOIN clients c ON o.client_id = c.id 
                ORDER BY o.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT o.*, c.name AS client_name, c.email AS client_email 
                FROM orders o 
                INNER JOIN clients c ON o.client_id = c.id 
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId) {
        $sql = "SELECT i.*, p.name AS product_name, p.image 
                FROM order_items i 
                INNER JOIN products p ON i.product_id = p.id 
                WHERE i.order_id = :order_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar o status do pedido (Pendente, Pago, Cancelado, etc)
    public function updateStatus($orderId, $status) {
        $sql = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id', $orderId);
        return $stmt->execute();
    }

    // Grava o pedido principal e retorna o ID criado
    public function createOrder($clientId, $totalAmount, $paymentMethod) {
        $sql = "INSERT INTO orders (client_id, total_amount, status, payment_method) 
                VALUES (:client_id, :total_amount, 'Pendente', :payment_method)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':client_id', $clientId);
        $stmt->bindValue(':total_amount', $totalAmount);
        $stmt->bindValue(':payment_method', $paymentMethod);
        
        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Retorna o ID do pedido
        }
        return false;
    }

    // Grava um item do pedido
    public function createOrderItem($orderId, $productId, $quantity, $unitPrice, $subtotal) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, unit_price, subtotal) 
                VALUES (:order_id, :product_id, :quantity, :unit_price, :subtotal)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':order_id', $orderId);
        $stmt->bindValue(':product_id', $productId);
        $stmt->bindValue(':quantity', $quantity);
        $stmt->bindValue(':unit_price', $unitPrice);
        $stmt->bindValue(':subtotal', $subtotal);
        
        return $stmt->execute();
    }
}