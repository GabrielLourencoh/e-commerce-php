<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit;
    }

    require_once __DIR__ . '/../../../dao/products/ProductDAO.php';

    $productDAO = new ProductDAO();
    $products = $productDAO->getAllProducts();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">
    <div class="w-64 bg-gray-900 text-white flex flex-col justify-between">
        <div>
            <div class="p-5 border-b border-gray-800">
                <h1 class="text-xl font-bold text-blue-400">Admin</h1>
                <p class="text-xs text-gray-400 mt-1">Painel do Administrador</p>
            </div>
            <nav class="p-4 space-y-2">
                <a href="../dashboard.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Dashboard
                </a>
                <a href="../categories/index.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Categorias
                </a>
                <a href="index.php" class="block py-2.5 px-4 rounded bg-gray-800 text-white font-medium text-sm transition-colors">
                    Produtos
                </a>
                <a href="../clients/index.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Clientes
                </a>
                <a href="../orders/index.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Pedidos
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-800">
            <div class="mb-2">
                <span class="block text-xs text-gray-400">Logado como:</span>
                <span class="text-sm font-semibold text-white"><?= $_SESSION['admin_name'] ?? 'Admin' ?></span>
            </div>
            <a href="../../../controllers/admins/LogoutController.php" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white text-xs font-medium py-2 rounded transition-colors">
                Sair
            </a>
        </div>
    </div>
    <div class="flex-1 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Produtos</h2>
            <a href="create.php" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded">
                + Novo Produto
            </a>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-700 uppercase">
                    <tr>
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Nome</th>
                        <th class="py-3 px-4">Categoria</th>
                        <th class="py-3 px-4">Preço</th>
                        <th class="py-3 px-4">Estoque</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4 text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="7" class="py-4 px-4 text-center text-gray-500">Nenhum produto cadastrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="py-3 px-4 font-semibold"><?= $product['id'] ?></td>
                                <td class="py-3 px-4 font-medium text-gray-900"><?= $product['name'] ?></td>
                                <td class="py-3 px-4"><?= $product['category_name'] ?></td>
                                <td class="py-3 px-4 font-semibold text-gray-800">R$ <?= number_format($product['price'], 2, ',', '.') ?></td>
                                <td class="py-3 px-4"><?= $product['stock'] ?> un.</td>
                                <td class="py-3 px-4">
                                    <?php if ($product['active'] == 1): ?>
                                        <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded text-xs font-medium">Ativo</span>
                                    <?php else: ?>
                                        <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded text-xs font-medium">Inativo</span>
                                    <?php endif; ?>
                                </td>
                                <td class="py-3 px-4 text-right space-x-2">
                                    <a href="update.php?id=<?= $product['id'] ?>" class="text-blue-600 hover:underline">Editar</a>
                                    <button onclick="deleteProduct(<?= $product['id'] ?>)" class="text-red-600 hover:underline">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function deleteProduct(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                $.ajax({
                    url: '../../../controllers/products/ProductController.php',
                    type: 'POST',
                    data: { action: 'delete', id: id },
                    success: function(response) {
                        if (response.trim() === 'sucesso') {
                            location.reload();
                        } else {
                            alert(response);
                        }
                    },
                    error: function() {
                        alert('Erro ao tentar excluir o produto.');
                    }
                });
            }
        }
    </script>
</body>
</html>