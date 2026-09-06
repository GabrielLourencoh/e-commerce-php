<?php

require_once __DIR__ . '/../../../config/Connection.php';
require_once __DIR__ . '/../../models/clients/Client.php';

class ClientDAO {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    public function insert(Client $client) {
        $sqlEmail = "SELECT id FROM clients WHERE email = :email";
        $stmtEmail = $this->conn->prepare($sqlEmail);
        $stmtEmail->bindValue(':email', $client->getEmail());
        $stmtEmail->execute();

        if ($stmtEmail->rowCount() > 0) {
            return "Este e-mail já está cadastrado!";
        }

        $sqlCpf = "SELECT id FROM clients WHERE cpf = :cpf";
        $stmtCpf = $this->conn->prepare($sqlCpf);
        $stmtCpf->bindValue(':cpf', $client->getCpf());
        $stmtCpf->execute();

        if ($stmtCpf->rowCount() > 0) {
            return "Este CPF já está cadastrado!";
        }

        $sql = "INSERT INTO clients (name, email, password, cpf, phone, address, number, complement, neighborhood, city, state, cep) 
                VALUES (:name, :email, :password, :cpf, :phone, :address, :number, :complement, :neighborhood, :city, :state, :cep)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':name', $client->getName());
        $stmt->bindValue(':email', $client->getEmail());
        $stmt->bindValue(':password', $client->getPassword());
        $stmt->bindValue(':cpf', $client->getCpf());
        $stmt->bindValue(':phone', $client->getPhone());
        $stmt->bindValue(':address', $client->getAddress());
        $stmt->bindValue(':number', $client->getNumber());
        $stmt->bindValue(':complement', $client->getComplement());
        $stmt->bindValue(':neighborhood', $client->getNeighborhood());
        $stmt->bindValue(':city', $client->getCity());
        $stmt->bindValue(':state', $client->getState());
        $stmt->bindValue(':cep', $client->getCep());

        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return "Erro ao realizar o cadastro!";
        }

        return "Cadastro realizado com sucesso!";
    }

    public function login($email, $password) {
        $sql = "SELECT id, name, email, password FROM clients WHERE email = :email";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 0) {
            return false;
        }

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        unset($user['password']);
        return $user;
    }

    public function getById($id) {
        $sql = "SELECT id, name, email FROM clients WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($id, $name, $email) {
        $sql = "UPDATE clients SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
?>