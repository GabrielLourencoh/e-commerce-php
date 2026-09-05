<?php
require_once __DIR__ . '/../../../config/Connection.php';
require_once __DIR__ . '/../../models/admins/Admin.php';

class AdminDAO {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    public function login($email, $password) {
        $sql = "SELECT id, name, email FROM admins WHERE email = :email AND password = :password AND active = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }
}

?>