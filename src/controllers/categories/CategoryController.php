<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        echo "Acesso negado!";
        exit;
    }

    require_once __DIR__ . '/../../dao/categories/CategoryDAO.php';
    require_once __DIR__ . '/../../models/categories/Category.php';

    $action = $_POST['action'] ?? '';
    $categoryDAO = new CategoryDAO();

    if ($action === 'create') {
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $active = isset($_POST['active']) ? 1 : 0;

        if (empty($name)) {
            echo "O nome da categoria é obrigatório!";
            exit;
        }

        $category = new Category();
        $category->setName($name);
        $category->setDescription($description);
        $category->setActive($active);

        echo $categoryDAO->insert($category);
        exit;
    }

    if ($action === 'update') {
        $id = $_POST['id'] ?? '';
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $active = isset($_POST['active']) ? 1 : 0;

        if (empty($id) || empty($name)) {
            echo "Preencha os campos obrigatórios!";
            exit;
        }

        $category = new Category();
        $category->setId($id);
        $category->setName($name);
        $category->setDescription($description);
        $category->setActive($active);

        echo $categoryDAO->update($category);
        exit;
    }

    if ($action === 'delete') {
        $id = $_POST['id'] ?? '';

        if (empty($id)) {
            echo "ID inválido!";
            exit;
        }

        echo $categoryDAO->delete($id);
        exit;
    }

?>