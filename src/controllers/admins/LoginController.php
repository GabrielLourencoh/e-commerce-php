<?php

session_start();

require_once __DIR__ . '/../../dao/admins/AdminDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo "Preencha todos os campos!";
        exit;
    }
    
    $adminDAO = new AdminDAO();
    
    $admin = $adminDAO->login($email, $password);

    if (!$admin) {
        echo "Credenciais inválidas ou conta inativa!";
        exit;
    }

    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['admin_name'] = $admin['name'];
    $_SESSION['admin_email'] = $admin['email'];

    echo "sucesso";
    exit;
}

?>