<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../login.php");
        exit;
    }

    require_once __DIR__ . '/../../../dao/orders/OrderDAO.php';

    $orderDAO = new OrderDAO();
    $orders = $orderDAO->getAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Pedidos - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Pedidos Realizados</h1>
            <a href="../dashboard.php" class="text-sm text-gray-600 hover:underline">← Voltar ao Dashboard</a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase">
                        <th class="p-4">#ID</th>
                        <th class="p-4">Cliente</th>
                        <th class="p-4">Pagamento</th>
                        <th class="p-4">Total</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-center">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">Nenhum pedido encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="p-4 font-bold">#<?= $order['id'] ?></td>
                                <td class="p-4">
                                    <div class="font-medium"><?= $order['client_name'] ?></div>
                                    <div class="text-xs text-gray-500"><?= $order['client_email'] ?></div>
                                </td>
                                <td class="p-4"><?= $order['payment_method'] ?></td>
                                <td class="p-4 font-bold">R$ <?= number_format($order['total_amount'], 2, ',', '.') ?></td>
                                <td class="p-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                        <?= $order['status'] === 'Pendente' ? 'bg-yellow-100 text-yellow-800' : '' ?>
                                        <?= $order['status'] === 'Pago' ? 'bg-green-100 text-green-800' : '' ?>
                                        <?= $order['status'] === 'Cancelado' ? 'bg-red-100 text-red-800' : '' ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <a href="view.php?id=<?= $order['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded">
                                        Detalhes
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>