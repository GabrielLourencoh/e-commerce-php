<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../login.php");
        exit;
    }

    require_once __DIR__ . '/../../../dao/clients/ClientDAO.php';

    $clientDAO = new ClientDAO();
    $clients = $clientDAO->getAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Clientes - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Clientes Cadastrados</h1>
            <a href="../dashboard.php" class="text-sm text-gray-600 hover:underline">← Voltar ao Dashboard</a>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase">
                        <th class="p-4">#ID</th>
                        <th class="p-4">Nome</th>
                        <th class="p-4">E-mail</th>
                        <th class="p-4">CPF</th>
                        <th class="p-4">Telefone</th>
                        <th class="p-4">Cidade/UF</th>
                        <th class="p-4">Data Cadastro</th>
                        <th class="p-4 text-center">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    <?php if (empty($clients)): ?>
                        <tr>
                            <td colspan="8" class="p-4 text-center text-gray-500">Nenhum cliente encontrado.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($clients as $client): ?>
                            <tr>
                                <td class="p-4 font-bold">#<?= $client['id'] ?></td>
                                <td class="p-4"><?= $client['name'] ?></td>
                                <td class="p-4"><?= $client['email'] ?></td>
                                <td class="p-4"><?= $client['cpf'] ?? '-' ?></td>
                                <td class="p-4"><?= $client['phone'] ?? '-' ?></td>
                                <td class="p-4"><?= $client['city'] . '/' . $client['state'] ?? '-' ?></td>
                                <td class="p-4"><?= date('d/m/Y H:i', strtotime($client['created_at'])) ?></td>
                                <td class="p-4 text-center">
                                    <a href="view.php?id=<?= $client['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1.5 rounded">
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