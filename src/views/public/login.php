<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">
    <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Entrar na Conta</h2>

        <div id="mensagem" class="hidden mb-4 p-3 rounded text-sm font-medium text-center"></div>
        <form id="form-login" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
                <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded text-sm transition-colors mt-2">
                Entrar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Ainda não tem conta? <a href="register.php" class="text-blue-600 hover:underline">Cadastre-se</a>
        </p>
    </div>

    <script>
        $('#form-login').submit(function(e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: '../../controllers/clients/LoginController.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.trim() === 'sucesso') {
                        window.location.href = '../../../index.php';
                    } else {
                        $('#mensagem')
                            .text(response)
                            .removeClass('hidden bg-green-100 text-green-700')
                            .addClass('bg-red-100 text-red-700');
                    }
                },
                error: function() {
                    $('#mensagem')
                        .text('Ocorreu um erro ao tentar realizar o login.')
                        .removeClass('hidden bg-green-100 text-green-700')
                        .addClass('bg-red-100 text-red-700');
                }
            });
        });
    </script>
</body>
</html> 