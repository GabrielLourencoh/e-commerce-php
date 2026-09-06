<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen py-10">
    <div class="max-w-2xl w-full bg-white p-8 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Cadastro</h2>

        <div id="mensagem" class="hidden mb-4 p-3 rounded text-sm font-medium text-center"></div>
        <form id="form-register" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome Completo *</label>
                    <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">E-mail *</label>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Senha *</label>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CPF *</label>
                    <input type="text" name="cpf" maxlength="14" required placeholder="000.000.000-00" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefone</label>
                    <input type="text" name="phone" placeholder="(00) 00000-0000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <hr class="my-4 border-gray-200">
            <h3 class="text-md font-semibold text-gray-700">Endereço de Entrega</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Endereço (Rua/Avenida)</label>
                    <input type="text" name="address" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Número</label>
                    <input type="text" name="number" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Complemento</label>
                    <input type="text" name="complement" placeholder="Apto, Bloco, etc." class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Bairro</label>
                    <input type="text" name="neighborhood" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                    <input type="text" name="city" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado (UF)</label>
                    <input type="text" name="state" maxlength="2" placeholder="SP" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500 uppercase">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">CEP</label>
                    <input type="text" name="cep" maxlength="9" placeholder="00000-000" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded text-sm transition-colors mt-4">
                Cadastrar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Já tem conta? <a href="login.php" class="text-blue-600 hover:underline">Faça login</a>
        </p>
    </div>
    <script>
        $('#form-register').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '../../controllers/clients/ClientController.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    var mensagemDiv = $('#mensagem');

                    if (response.indexOf('sucesso') !== -1) {
                        mensagemDiv
                            .text(response)
                            .removeClass('hidden bg-red-100 text-red-700')
                            .addClass('bg-green-100 text-green-700');
                        $('#form-register')[0].reset();
                    } else {
                        mensagemDiv
                            .text(response)
                            .removeClass('hidden bg-green-100 text-green-700')
                            .addClass('bg-red-100 text-red-700');
                    }
                },
                error: function() {
                    $('#mensagem')
                        .text('Ocorreu um erro inesperado na requisição.')
                        .removeClass('hidden bg-green-100 text-green-700')
                        .addClass('bg-red-100 text-red-700');
                }
            });
        });
    </script>
</body>
</html>