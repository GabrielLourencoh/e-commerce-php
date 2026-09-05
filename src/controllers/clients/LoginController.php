<?php

session_start();

require_once __DIR__ . '/../../dao/clients/ClientDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos!";
        exit;
    }

    $clientDAO = new ClientDAO();
    $user = $clientDAO->login($email, $password);

    if (!$user) {
        echo "E-mail ou senha incorretos!";
        exit;
    }

    $_SESSION['client_id'] = $user['id'];
    $_SESSION['client_name'] = $user['name'];
    $_SESSION['client_email'] = $user['email'];

    echo "sucesso";
    exit;
}

?>