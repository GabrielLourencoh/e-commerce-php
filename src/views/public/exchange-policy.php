<?php
session_start();
$basePath = '../../../';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Troca e Devolução</title>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Política de Troca e Devolução</h1>

            <div class="space-y-8 text-gray-700 leading-relaxed">
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Direito de Arrependimento (Lei 8.078/90 - Art. 49)</h2>
                    <p>O consumidor tem o direito de desistir da compra em até <strong>7 (sete) dias corridos</strong> a contar do recebimento do produto, sem necessidade de justificativa. O reembolso será integral, incluindo o valor do frete.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Troca por Defeito de Fabricação (Lei 8.078/90 - Art. 26)</h2>
                    <p>Produtos com defeito de fabricação podem ser trocados em até <strong>30 (trinta) dias corridos</strong> para produtos não duráveis e <strong>90 (noventa) dias corridos</strong> para produtos duráveis, contados da data do recebimento.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Condições para Troca ou Devolução</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Produto sem sinais de uso, instalação ou danos acidentais;</li>
                        <li>Na embalagem original, com todas as etiquetas, tags, manuais e acessórios;</li>
                        <li>Acompanhado da nota fiscal (DANFE) ou declaração de conteúdo;</li>
                        <li>Solicitação realizada dentro dos prazos legais.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Frete</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Arrependimento (7 dias):</strong> frete por nossa conta;</li>
                        <li><strong>Defeito de fabricação:</strong> frete por nossa conta;</li>
                        <li><strong>Outros motivos (tamanho, cor, gosto pessoal):</strong> frete por conta do cliente.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Como Solicitar</h2>
                    <ol class="list-decimal list-inside space-y-2">
                        <li>Acesse sua conta e vá em "Meus Pedidos";</li>
                        <li>Selecione o pedido e clique em "Solicitar Troca/Devolução";</li>
                        <li>Preencha o motivo e envie fotos se for defeito;</li>
                        <li>Aguarde análise (até 2 dias úteis);</li>
                        <li>Receba o código de postagem por e-mail;</li>
                        <li>Poste em qualquer agência dos Correios.</li>
                    </ol>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">6. Restituição de Valores</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Cartão de crédito:</strong> estorno na fatura seguinte ou subsequente (conforme administradora);</li>
                        <li><strong>PIX/Boleto:</strong> depósito em conta corrente do titular em até 10 dias úteis após recebimento e análise do produto;</li>
                        <li><strong>Vale-troca:</strong> disponível imediatamente após aprovação, válido por 180 dias.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">7. Produtos Não Elegíveis</h2>
                    <p>Não aceitamos troca/devolução de: produtos personalizados, perecíveis, íntimos (roupas íntimas, maquiagem), software com licença ativada, e itens de higiene pessoal com lacre violado.</p>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>