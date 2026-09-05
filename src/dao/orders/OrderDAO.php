<?php
require_once __DIR__ . '/../../../config/Connection.php';

class OrderDAO {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
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