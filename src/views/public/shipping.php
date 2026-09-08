<?php
session_start();
$basePath = '../../../';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frete e Prazos de Entrega</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <header class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="<?= $basePath ?>index.php" class="text-2xl font-bold text-gray-900">E-commerce</a>
            <div class="flex items-center space-x-4">
                <a href="<?= $basePath ?>src/views/public/cart.php" class="text-sm font-medium text-gray-700 hover:text-blue-600">Meu Carrinho</a>
                <?php if (isset($_SESSION['client_id'])): ?>
                    <span class="text-sm font-medium text-gray-700">Olá, <?= $_SESSION['client_name'] ?></span>
                    <a href="<?= $basePath ?>src/views/public/profile.php" class="text-sm font-medium text-blue-600 hover:underline">Meu Perfil</a>
                    <a href="<?= $basePath ?>src/controllers/clients/LogoutController.php" class="text-sm text-red-600 hover:underline">Sair</a>
                <?php else: ?>
                    <a href="<?= $basePath ?>src/views/public/login.php" class="text-sm font-medium text-gray-700 hover:text-blue-600">Entrar</a>
                    <a href="<?= $basePath ?>src/views/public/register.php" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-4 py-2 rounded transition-colors">Criar Conta</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-12">
        <a href="<?= $basePath ?>index.php" class="text-sm text-gray-600 hover:underline mb-6 inline-block">← Voltar ao catálogo</a>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Frete e Prazos de Entrega</h1>

            <div class="space-y-8 text-gray-700 leading-relaxed">
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Como Calcular o Frete</h2>
                    <p>No carrinho de compras, insira seu CEP no campo "Calcular frete" e clique em "Calcular". O sistema exibirá automaticamente as opções disponíveis com valores e prazos estimados para seu endereço.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Modalidades de Entrega</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Modalidade</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Prazo Estimado</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Descrição</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">PAC (Correios)</td>
                                    <td class="px-4 py-3">5 a 15 dias úteis</td>
                                    <td class="px-4 py-3">Econômica, para todo o Brasil</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Sedex (Correios)</td>
                                    <td class="px-4 py-3">1 a 5 dias úteis</td>
                                    <td class="px-4 py-3">Expressa, para todo o Brasil</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Transportadora</td>
                                    <td class="px-4 py-3">2 a 10 dias úteis</td>
                                    <td class="px-4 py-3">Para volumes maiores/regiões específicas</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Retirada na Loja</td>
                                    <td class="px-4 py-3">1 dia útil</td>
                                    <td class="px-4 py-3">Disponível apenas em SP Capital</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Frete Grátis</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Sul e Sudeste:</strong> compras acima de <strong>R$ 299,00</strong>;</li>
                        <li><strong>Centro-Oeste e Nordeste:</strong> compras acima de <strong>R$ 399,00</strong>;</li>
                        <li><strong>Norte:</strong> compras acima de <strong>R$ 499,00</strong>.</li>
                    </ul>
                    <p class="mt-2 text-sm text-gray-600">*Valores e regiões sujeitos a alteração em campanhas promocionais.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Prazos Importantes</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>O prazo começa a contar após a <strong>confirmação do pagamento</strong> (não no momento do pedido);</li>
                        <li>Pedidos aprovados até 14h (dias úteis) são despachados no mesmo dia;</li>
                        <li>Pedidos após 14h ou em finais de semana/feriados: próximo dia útil;</li>
                        <li>O prazo exibido é <strong>estimado</strong> e pode variar por fatores externos (greves, clima, etc.).</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Rastreamento</h2>
                    <p>Assim que o pedido for despachado, você receberá um e-mail com o código de rastreamento. Também pode acompanhar em "Meu Perfil" > "Meus Pedidos" clicando no pedido desejado.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Entrega</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Entregas de segunda a sexta, das 8h às 18h (Correios) ou 8h às 20h (transportadoras);</li>
                        <li>São feitas até <strong>3 tentativas</strong> em dias úteis consecutivos;</li>
                        <li>Após 3 tentativas sem sucesso, o pedido retorna ao nosso centro de distribuição;</li>
                        <li>É necessário alguém maior de 18 anos no local para receber e assinar o comprovante.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Problemas na Entrega</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Endereço incorreto/incompleto:</strong> entre em contato imediatamente para correção. Se já despachado, aguarde retorno e nova postagem (custo por conta do cliente se erro no cadastro);</li>
                        <li><strong>Embalagem violada/avariada:</strong> <strong>recuse o recebimento</strong> e nos avise imediatamente. Enviaremos reposição sem custo;</li>
                        <li><strong>Pedido não entregue mas status "Entregue":</strong> verifique com vizinhos/portaria. Se não localizar, abra reclamação nos Correios/transportadora e nos informe.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Regiões com Restrição</h2>
                    <p>Algumas áreas de risco ou de difícil acesso podem ter prazo adicional ou apenas retirada na agência dos Correios mais próxima. O sistema informará no cálculo do frete.</p>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>