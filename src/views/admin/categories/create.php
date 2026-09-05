<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Categoria - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Cadastrar Categoria</h2>
        <div id="mensagem" class="hidden mb-4 p-3 rounded text-sm text-center font-medium"></div>

        <form id="form-category-create" class="space-y-4">
            <input type="hidden" name="action" value="create">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome da Categoria *</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="active" value="1" id="active" checked class="h-4 w-4 text-blue-600 rounded">
                <label for="active" class="ml-2 text-sm text-gray-700">Categoria Ativa</label>
            </div>

            <div class="flex justify-between items-center pt-2">
                <a href="index.php" class="text-sm text-gray-600 hover:underline">Voltar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded">
                    Salvar Categoria
                </button>
            </div>
        </form>
    </div>

    <script>
        $('#form-category-create').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: '../../../controllers/categories/CategoryController.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.trim() === 'sucesso') {
                        window.location.href = 'index.php';
                    } else {
                        $('#mensagem')
                            .text(response)
                            .removeClass('hidden bg-green-100 text-green-700')
                            .addClass('bg-red-100 text-red-700');
                    }
                },
                error: function() {
                    $('#mensagem')
                        .text('Erro de conexão ao salvar categoria.')
                        .removeClass('hidden bg-green-100 text-green-700')
                        .addClass('bg-red-100 text-red-700');
                }
            });
        });
    </script>
</body>
</html>