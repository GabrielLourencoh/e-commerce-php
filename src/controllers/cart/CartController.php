<?php

    session_start();

    $action = $_POST['action'] ?? $_GET['action'] ?? '';

    if ($action === 'add') {
        $productId = $_POST['product_id'] ?? null;
        $quantity = (int)($_POST['quantity'] ?? 1);

        if (!$productId || $quantity <= 0) {
            echo "Produto inválido.";
            exit;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity;
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }

        echo "sucesso";
        exit;
    }

    if ($action === 'remove') {
        $productId = $_POST['product_id'] ?? null;

        if ($productId && isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }

        echo "sucesso";
        exit;
    }

    if ($action === 'clear') {
        unset($_SESSION['cart']);
        echo "sucesso";
        exit;
    }
?>