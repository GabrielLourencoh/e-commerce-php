<?php
    session_start();

    require_once __DIR__ . '/config/Connection.php';

    $database = new Connection();
    $conn = $database->connect();

    $sql = "SELECT p.*, c.name AS category_name 
            FROM products p 
            INNER JOIN categories c ON p.category_id = c.id 
            WHERE p.active = 1 
            ORDER BY p.id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-blue-600">E-commerce</a>

            <div class="flex items-center space-x-4">
                <a href="src/views/public/cart.php" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                    Meu Carrinho
                </a>

                <?php if (isset($_SESSION['client_id'])): ?>
                    <span class="text-sm font-medium text-gray-700">Olá, <?= $_SESSION['client_name'] ?></span>
                    <a href="src/controllers/clients/LogoutController.php" class="text-sm text-red-600 hover:underline">Sair</a>
                <?php else: ?>
                    <a href="src/views/public/login.php" class="text-sm font-medium text-gray-700 hover:text-blue-600">Entrar</a>
                    <a href="src/views/public/register.php" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition-colors">Criar Conta</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="max-w-6xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Produtos em Destaque</h1>
        <?php if (empty($products)): ?>
            <p class="text-gray-500">Nenhum produto cadastrado no momento.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                        <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="w-full h-48 object-cover">
                        
                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <span class="text-xs text-blue-600 font-semibold uppercase tracking-wider"><?= $product['category_name'] ?></span>
                                <h3 class="text-md font-bold text-gray-800 mt-1"><?= $product['name'] ?></h3>
                                <p class="text-xs text-gray-500 mt-1 line-clamp-2"><?= $product['description'] ?></p>
                            </div>

                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">R$ <?= number_format($product['price'], 2, ',', '.') ?></span>
                                
                                <!-- Botão chama a função AJAX de adicionar ao carrinho -->
                                <button onclick="addToCart(<?= $product['id'] ?>)" class="bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold px-3 py-1.5 rounded transition-colors">
                                    Comprar
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
    <script>
        function addToCart(productId) {
            $.ajax({
                url: 'src/controllers/cart/CartController.php',
                type: 'POST',
                data: {
                    action: 'add',
                    product_id: productId,
                    quantity: 1
                },
                success: function(response) {
                    if (response.trim() === 'sucesso') {
                        // Redireciona para a página do carrinho ao clicar em comprar
                        window.location.href = 'src/views/public/cart.php';
                    } else {
                        alert(response);
                    }
                },
                error: function() {
                    alert('Erro ao adicionar produto ao carrinho.');
                }
            });
        }
    </script>
</body>
</html>