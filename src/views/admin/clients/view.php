<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header("Location: ../login.php");
        exit;
    }

    require_once __DIR__ . '/../../../dao/clients/ClientDAO.php';

    $clientDAO = new ClientDAO();
    $clientId = $_GET['id'] ?? null;

    if (!$clientId) {
        header("Location: index.php");
        exit;
    }

    $client = $clientDAO->getByIdFull($clientId);

    if (!$client) {
        echo "Cliente não encontrado.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente #<?= $client['id'] ?> - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <a href="index.php" class="text-sm text-gray-600 hover:underline mb-4 inline-block">← Voltar para lista de clientes</a>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <h1 class="text-xl font-bold text-gray-800 mb-4">Cliente #<?= $client['id'] ?></h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nome</label>
                    <p class="text-gray-800"><?= $client['name'] ?></p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">E-mail</label>
                    <p class="text-gray-800"><?= $client['email'] ?></p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">CPF</label>
                    <p class="text-gray-800"><?= $client['cpf'] ?? '-' ?></p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Telefone</label>
                    <p class="text-gray-800"><?= $client['phone'] ?? '-' ?></p>
                </div>
            </div>

            <div class="border-t pt-4 mb-4">
                <h2 class="text-md font-bold text-gray-700 mb-3">Endereço</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Endereço</label>
                        <p class="text-gray-800"><?= $client['address'] ?? '-' ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Número</label>
                        <p class="text-gray-800"><?= $client['number'] ?? '-' ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Complemento</label>
                        <p class="text-gray-800"><?= $client['complement'] ?? '-' ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Bairro</label>
                        <p class="text-gray-800"><?= $client['neighborhood'] ?? '-' ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Cidade</label>
                        <p class="text-gray-800"><?= $client['city'] ?? '-' ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Estado</label>
                        <p class="text-gray-800"><?= $client['state'] ?? '-' ?></p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">CEP</label>
                        <p class="text-gray-800"><?= $client['cep'] ?? '-' ?></p>
                    </div>
                </div>
            </div>

            <div class="border-t pt-4">
                <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Data de Cadastro</label>
                <p class="text-gray-800"><?= date('d/m/Y H:i:s', strtotime($client['created_at'])) ?></p>
            </div>
        </div>
    </div>
</body>
</html>