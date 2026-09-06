<?php
    session_start();

    if (!isset($_SESSION['client_id'])) {
        header("Location: login.php");
        exit;
    }

    require_once __DIR__ . '/../../dao/clients/ClientDAO.php';

    $clientDAO = new ClientDAO();
    $clientId = $_SESSION['client_id'];

    $mensagem = '';
    $tipoMensagem = '';

    // Processa a atualização do perfil
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');

        if (!empty($name) && !empty($email)) {
            if ($clientDAO->updateProfile($clientId, $name, $email)) {
                // Atualiza o nome na sessão
                $_SESSION['client_name'] = $name;
                $mensagem = "Perfil atualizado com sucesso!";
                $tipoMensagem = "green";
            } else {
                $mensagem = "Erro ao atualizar o perfil.";
                $tipoMensagem = "red";
            }
        } else {
            $mensagem = "Preencha todos os campos.";
            $tipoMensagem = "red";
        }
    }

    // Carrega os dados atuais
    $client = $clientDAO->getById($clientId);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - E-commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="../../../index.php" class="text-2xl font-bold text-blue-600">E-commerce</a>
            <a href="../../../index.php" class="text-sm text-gray-600 hover:underline">← Voltar para Loja</a>
        </div>
    </header>
    <main class="max-w-md mx-auto px-4 py-8">
        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
            <h1 class="text-xl font-bold text-gray-800 mb-6">Meu Perfil</h1>

            <?php if (!empty($mensagem)): ?>
                <div class="mb-4 p-3 rounded text-sm font-medium bg-<?= $tipoMensagem ?>-100 text-<?= $tipoMensagem ?>-700">
                    <?= $mensagem ?>
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">Nome Completo</label>
                    <input type="text" name="name" value="<?= $client['name'] ?>" required
                        class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:border-blue-600">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-1">E-mail</label>
                    <input type="email" name="email" value="<?= $client['email'] ?>" required
                        class="w-full border border-gray-300 rounded p-2 text-sm focus:outline-none focus:border-blue-600">
                </div>

                <button type="submit" class="w-full bg-gray-800 hover:bg-gray-900 text-white font-semibold py-2 rounded text-sm transition-colors">
                    Salvar Alterações
                </button>
            </form>
        </div>
    </main>
</body>
</html>