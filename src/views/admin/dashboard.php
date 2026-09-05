<?php
    session_start();    

    if (!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit;
    }

    require_once __DIR__ . '/../../../config/Connection.php';

    $database = new Connection();
    $conn = $database->connect();

    $sqlProducts = "SELECT COUNT(*) AS total FROM products";
    $stmtProducts = $conn->prepare($sqlProducts);
    $stmtProducts->execute();
    $totalProducts = $stmtProducts->fetch(PDO::FETCH_ASSOC)['total'];

    $sqlCategories = "SELECT COUNT(*) AS total FROM categories";
    $stmtCategories = $conn->prepare($sqlCategories);
    $stmtCategories->execute();
    $totalCategories = $stmtCategories->fetch(PDO::FETCH_ASSOC)['total'];

    $sqlOrders = "SELECT COUNT(*) AS total_orders, IFNULL(SUM(total_amount), 0) AS total_sales FROM orders";
    $stmtOrders = $conn->prepare($sqlOrders);
    $stmtOrders->execute();
    $orderData = $stmtOrders->fetch(PDO::FETCH_ASSOC);

    $totalOrders = $orderData['total_orders'];
    $totalSales = $orderData['total_sales'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <div class="w-64 bg-gray-900 text-white flex flex-col justify-between">
        <div>
            <div class="p-5 border-b border-gray-800">
                <h1 class="text-xl font-bold text-blue-400">Admin</h1>
                <p class="text-xs text-gray-400 mt-1">Painel do Administrador</p>
            </div>
            <nav class="p-4 space-y-2">
                <a href="dashboard.php" class="block py-2.5 px-4 rounded bg-gray-800 text-white font-medium text-sm">
                    Dashboard
                </a>
                <a href="categories/index.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Categorias
                </a>
                <a href="products/index.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Produtos
                </a>
                <a href="orders/index.php" class="block py-2.5 px-4 rounded hover:bg-gray-800 text-gray-300 font-medium text-sm transition-colors">
                    Pedidos
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-gray-800">
            <div class="mb-2">
                <span class="block text-xs text-gray-400">Logado como:</span>
                <span class="text-sm font-semibold text-white"><?= $_SESSION['admin_name'] ?></span>
            </div>
            <a href="../../controllers/admins/LogoutController.php" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white text-xs font-medium py-2 rounded transition-colors">
                Sair
            </a>
        </div>
    </div>

    <main class="flex-1 p-8">
    
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Visão Geral</h2>
                <p class="text-sm text-gray-600">Acompanhe as métricas principais do e-commerce</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total de Vendas</span>
                <h3 class="text-2xl font-bold text-gray-800 mt-2">R$ <?= number_format($totalSales, 2, ',', '.') ?></h3>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pedidos</span>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalOrders ?></h3>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Produtos Cadastrados</span>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalProducts ?></h3>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Categorias</span>
                <h3 class="text-2xl font-bold text-gray-800 mt-2"><?= $totalCategories ?></h3>
            </div>

        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Ações Rápidas</h3>
            <div class="flex space-x-4">
                <a href="categories/create.php" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition-colors">
                    + Nova Categoria
                </a>
                <a href="products/create.php" class="bg-green-600 hover:bg-green-700 text-white text-sm font-medium px-4 py-2 rounded transition-colors">
                    + Novo Produto
                </a>
            </div>
        </div>
    </main>
</body>
</html>