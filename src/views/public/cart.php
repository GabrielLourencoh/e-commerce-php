<?php
    session_start();

    require_once __DIR__ . '/../../dao/products/ProductDAO.php';

    $productDAO = new ProductDAO();
    $cartProducts = [];
    $total = 0;

    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $id => $qty) {
            $product = $productDAO->getById($id);
            if ($product && $product['active'] == 1) {
                $product['cart_qty'] = $qty;
                $product['subtotal'] = $product['price'] * $qty;
                $total += $product['subtotal'];
                $cartProducts[] = $product;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Carrinho</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../../index.php" class="text-2xl font-bold text-blue-600">E-commerce</a>
            <a href="../../../index.php" class="text-sm bg-gray-800 hover:bg-gray-900 text-white px-3 py-1.5 rounded transition-colors">Continuar Comprando</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Carrinho de Compras</h1>
        <div id="mensagem" class="hidden mb-4 p-3 rounded text-sm font-medium text-center"></div>
        <?php if (empty($cartProducts)): ?>
            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 text-center">
                <p class="text-gray-600 mb-4">Seu carrinho está vazio.</p>
                <a href="../../../index.php" class="inline-block bg-gray-800 hover:bg-gray-900 text-white text-sm px-4 py-2 rounded">Ver Produtos</a>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase">
                            <th class="p-4">Produto</th>
                            <th class="p-4 text-center">Qtd</th>
                            <th class="p-4 text-right">Preço</th>
                            <th class="p-4 text-right">Subtotal</th>
                            <th class="p-4 text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        <?php foreach ($cartProducts as $item): ?>
                            <tr>
                                <td class="p-4 font-medium"><?= htmlspecialchars($item['name']) ?></td>
                                <td class="p-4 text-center"><?= $item['cart_qty'] ?></td>
                                <td class="p-4 text-right">R$ <?= number_format($item['price'], 2, ',', '.') ?></td>
                                <td class="p-4 text-right font-bold">R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
                                <td class="p-4 text-center">
                                    <button onclick="removeItem(<?= $item['id'] ?>)" class="text-red-600 hover:underline text-xs">Remover</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <span class="text-sm text-gray-500">Total do Pedido:</span>
                    <span class="text-2xl font-bold text-gray-900 ml-2">R$ <?= number_format($total, 2, ',', '.') ?></span>
                </div>

                <?php if (isset($_SESSION['client_id'])): ?>
                    <button id="btn-checkout" class="bg-gray-800 hover:bg-gray-900 text-white font-medium px-6 py-2.5 rounded text-sm transition-colors">
                        Finalizar Compra
                    </button>
                <?php else: ?>
                    <a href="login.php" class="bg-gray-800 hover:bg-gray-900 text-white font-medium px-6 py-2.5 rounded text-sm transition-colors">
                        Faça Login para Finalizar
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>
    <script>
        function removeItem(id) {
            $.post('../../controllers/cart/CartController.php', { action: 'remove', product_id: id }, function(res) {
                if (res.trim() === 'sucesso') {
                    window.location.reload();
                }
            });
        }

        $('#btn-checkout').click(function() {
            $(this).prop('disabled', true).text('Processando...');

            $.post('../../controllers/orders/OrderController.php', { payment_method: 'Pix / Boleto' }, function(response) {
                if (response.trim() === 'sucesso') {
                    alert('Pedido realizado com sucesso!');
                    window.location.href = '../../../index.php';
                } else {
                    $('#mensagem')
                        .text(response)
                        .removeClass('hidden bg-green-100 text-green-700')
                        .addClass('bg-red-100 text-red-700');
                    $('#btn-checkout').prop('disabled', false).text('Finalizar Compra');
                }
            });
        });
    </script>
</body>
</html>