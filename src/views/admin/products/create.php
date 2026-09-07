<?php
    session_start();

    if (!isset($_SESSION['admin_id'])) {
        header('Location: ../login.php');
        exit;
    }

    require_once __DIR__ . '/../../../dao/categories/CategoryDAO.php';

    $categoryDAO = new CategoryDAO();
    $categories = $categoryDAO->getCategories();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-sm border border-gray-200">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Cadastrar Produto</h2>
        <div id="mensagem" class="hidden mb-4 p-3 rounded text-sm text-center font-medium"></div>
        <form id="form-product-create" class="space-y-4" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create">

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Categoria *</label>
                <select name="category_id" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                    <option value="">Selecione uma categoria</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nome do Produto *</label>
                <input type="text" name="name" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
                <textarea name="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Preço (R$) *</label>
                    <input type="text" name="price" placeholder="0.00" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estoque *</label>
                    <input type="number" name="stock" value="0" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Imagem do Produto</label>
                <input type="file" name="image" accept="image/jpeg,image/png,image/webp,image/avif" class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">JPG, PNG, WebP ou AVIF. Máx. 2MB.</p>
            </div>
            <div class="flex items-center">
                <input type="checkbox" name="active" value="1" id="active" checked class="h-4 w-4 text-blue-600 rounded">
                <label for="active" class="ml-2 text-sm text-gray-700">Produto Ativo</label>
            </div>
            <div class="flex justify-between items-center pt-2">
                <a href="index.php" class="text-sm text-gray-600 hover:underline">Voltar</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded">
                    Salvar Produto
                </button>
            </div>
        </form>
    </div>

    <script>
        $('#form-product-create').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: '../../../controllers/products/ProductController.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
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
                        .text('Erro de conexão ao salvar produto.')
                        .removeClass('hidden bg-green-100 text-green-700')
                        .addClass('bg-red-100 text-red-700');
                }
            });
        });
    </script>
</body>
</html>