<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../login.php");
        exit;
    }

    require_once __DIR__ . '/../../../dao/orders/OrderDAO.php';

    $orderDAO = new OrderDAO();
    $orderId = $_GET['id'] ?? null;

    if (!$orderId) {
        header("Location: index.php");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['status'])) {
        $orderDAO->updateStatus($orderId, $_POST['status']);
    }

    $order = $orderDAO->getById($orderId);
    $items = $orderDAO->getOrderItems($orderId);

    if (!$order) {
        echo "Pedido não encontrado.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido #<?= $order['id'] ?> - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="index.php" class="text-sm text-gray-600 hover:underline mb-4 inline-block">← Voltar para lista de pedidos</a>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex justify-between items-center border-b pb-4 mb-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">Pedido #<?= $order['id'] ?></h1>
                    <p class="text-xs text-gray-500">Cliente: <?= $order['client_name'] ?> (<?= $order['client_email'] ?>)</p>
                </div>
                <form method="POST" class="flex items-center space-x-2">
                    <select name="status" class="text-sm border border-gray-300 rounded p-1.5 bg-white">
                        <option value="Pendente" <?= $order['status'] === 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                        <option value="Pago" <?= $order['status'] === 'Pago' ? 'selected' : '' ?>>Pago</option>
                        <option value="Enviado" <?= $order['status'] === 'Enviado' ? 'selected' : '' ?>>Enviado</option>
                        <option value="Cancelado" <?= $order['status'] === 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
                    </select>
                    <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white text-xs px-3 py-2 rounded">
                        Atualizar Status
                    </button>
                </form>
            </div>
            <h2 class="text-md font-bold text-gray-700 mb-3">Itens do Pedido</h2>
            <div class="divide-y divide-gray-100">
                <?php foreach ($items as $item): ?>
                    <div class="py-3 flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-800"><?= $item['product_name'] ?></p>
                            <p class="text-xs text-gray-500">Qtd: <?= $item['quantity'] ?> x R$ <?= number_format($item['unit_price'], 2, ',', '.') ?></p>
                        </div>
                        <span class="text-sm font-bold text-gray-900">R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="border-t pt-4 mt-4 text-right">
                <span class="text-sm text-gray-500">Total do Pedido:</span>
                <span class="text-xl font-bold text-gray-900 ml-2">R$ <?= number_format($order['total_amount'], 2, ',', '.') ?></span>
            </div>
        </div>
    </div>
</body>
</html>