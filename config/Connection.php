<?php

class Connection {
    private $host = "localhost";
    private $banco = "ecommerce_db";
    private $usuario = "root";
    private $senha = "";
    private $porta = "3306";

    private $conn;

    public function connect() {

        try {

            $this->conn = new PDO(
                "mysql:host={$this->host};port={$this->porta};dbname={$this->banco};charset=utf8",
                $this->usuario,
                $this->senha
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo "Erro na conexão: " . $e->getMessage();

        }

        return $this->conn;
    }
}

?>