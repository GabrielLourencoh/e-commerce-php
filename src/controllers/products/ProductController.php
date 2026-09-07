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

    $uploadDir = __DIR__ . '/../../../assets/public/images/products/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/avif'];
    $maxSize = 2 * 1024 * 1024;

    function handleImageUpload($file, $uploadDir, $allowedTypes, $maxSize) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        if ($file['size'] > $maxSize) {
            return "Arquivo muito grande. Máximo 2MB.";
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            return "Tipo de arquivo não permitido. Use JPG, PNG, WebP ou AVIF.";
        }

        $extension = match($mimeType) {
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
            'image/avif' => 'avif',
            default => 'jpg'
        };

        $fileName = 'produto_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $extension;
        $destination = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return "Erro ao salvar arquivo.";
        }

        return 'assets/public/images/products/' . $fileName;
    }

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

        $imagePath = null;
        if (isset($_FILES['image'])) {
            $result = handleImageUpload($_FILES['image'], $uploadDir, $allowedTypes, $maxSize);
            if (is_string($result) && str_starts_with($result, 'Erro') || str_starts_with($result, 'Arquivo') || str_starts_with($result, 'Tipo')) {
                echo $result;
                exit;
            }
            $imagePath = $result;
        }

        $product = new Product();
        $product->setCategoryId($category_id);
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice(str_replace(',', '.', $price));
        $product->setStock($stock);
        $product->setActive($active);
        $product->setImage($imagePath);

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

        $existingProduct = $productDAO->getById($id);
        $imagePath = $existingProduct['image'] ?? null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $result = handleImageUpload($_FILES['image'], $uploadDir, $allowedTypes, $maxSize);
            if (is_string($result) && str_starts_with($result, 'Erro') || str_starts_with($result, 'Arquivo') || str_starts_with($result, 'Tipo')) {
                echo $result;
                exit;
            }
            if ($result) {
                if ($imagePath && file_exists(__DIR__ . '/../../../' . $imagePath)) {
                    @unlink(__DIR__ . '/../../../' . $imagePath);
                }
                $imagePath = $result;
            }
        }

        $product = new Product();
        $product->setId($id);
        $product->setCategoryId($category_id);
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice(str_replace(',', '.', $price));
        $product->setStock($stock);
        $product->setActive($active);
        $product->setImage($imagePath);

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