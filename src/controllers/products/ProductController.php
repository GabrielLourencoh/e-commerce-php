<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo "Acesso negado!";
        exit;
    }

    require_once __DIR__ . '/../../dao/products/ProductDAO.php';
    require_once __DIR__ . '/../../models/products/Product.php';

    $action = $_POST['action'] ?? '';
    $productDAO = new ProductDAO();

    if ($action === 'create') {
        $category_id = $_POST['category_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $active = isset($_POST['active']) ? 1 : 0;

        if (empty($name) || empty($category_id) || empty($price)) {
            echo "Preencha os campos obrigatórios!";
            exit;
        }

        $product = new Product();
        $product->setCategoryId($category_id);
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice(str_replace(',', '.', $price));
        $product->setStock($stock);
        $product->setActive($active);

        echo $productDAO->insert($product);
        exit;
    }

    if ($action === 'update') {
        $id = $_POST['id'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $stock = $_POST['stock'] ?? 0;
        $active = isset($_POST['active']) ? 1 : 0;

        if (empty($id) || empty($name) || empty($category_id) || empty($price)) {
            echo "Preencha os campos obrigatórios!";
            exit;
        }

        $product = new Product();
        $product->setId($id);
        $product->setCategoryId($category_id);
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice(str_replace(',', '.', $price));
        $product->setStock($stock);
        $product->setActive($active);

        echo $productDAO->update($product);
        exit;
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            echo "ID inválido!";
            exit;
        }

        echo $productDAO->delete($id);
        exit;
    }
?>