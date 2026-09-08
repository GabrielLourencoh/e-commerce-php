<?php
session_start();
$basePath = '../../../';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Perguntas Frequentes</title>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Perguntas Frequentes</h1>

            <div class="space-y-8">
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Pedidos e Pagamentos</h2>
                    <dl class="space-y-6">
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Como faço um pedido?</dt>
                            <dd class="text-gray-700 leading-relaxed">Navegue pelo catálogo, clique em "Comprar" nos produtos desejados, acesse seu carrinho e clique em "Finalizar Compra". Você precisará estar logado ou criar uma conta para concluir.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Quais formas de pagamento são aceitas?</dt>
                            <dd class="text-gray-700 leading-relaxed">Aceitamos cartão de crédito, débito, PIX e boleto bancário. O processamento é feito via gateway de pagamento seguro.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Posso alterar ou cancelar meu pedido após finalizado?</dt>
                            <dd class="text-gray-700 leading-relaxed">Pedidos com status "Pendente" podem ser cancelados. Entre em contato conosco o mais rápido possível. Após status "Pago" ou "Enviado", alterações dependem de análise.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Como acompanho meu pedido?</dt>
                            <dd class="text-gray-700 leading-relaxed">Acesse "Meu Perfil" e vá em "Meus Pedidos". Lá você verá o status atual e histórico de atualizações.</dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Entrega e Frete</h2>
                    <dl class="space-y-6">
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Qual o prazo de entrega?</dt>
                            <dd class="text-gray-700 leading-relaxed">O prazo varia conforme seu CEP e a modalidade de frete escolhida. No carrinho, informe seu CEP para ver as opções e prazos estimados.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Vocês entregam para todo o Brasil?</dt>
                            <dd class="text-gray-700 leading-relaxed">Sim, entregamos em todo território nacional através dos Correios e transportadoras parceiras.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Como funciona o frete grátis?</dt>
                            <dd class="text-gray-700 leading-relaxed">Oferecemos frete grátis em compras acima de R$ 299,00 para regiões Sul e Sudeste, e acima de R$ 399,00 para as demais regiões.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">O que acontece se ninguém estiver no endereço para receber?</dt>
                            <dd class="text-gray-700 leading-relaxed">Serão feitas até 3 tentativas de entrega em dias úteis consecutivos. Após isso, o pedido retorna ao nosso centro de distribuição e entraremos em contato para reagendar ou reembolsar.</dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Trocas e Devoluções</h2>
                    <dl class="space-y-6">
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Qual o prazo para troca ou devolução?</dt>
                            <dd class="text-gray-700 leading-relaxed">Você tem até 30 dias corridos após o recebimento para solicitar troca ou devolução, conforme Código de Defesa do Consumidor.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">O produto deve estar na embalagem original?</dt>
                            <dd class="text-gray-700 leading-relaxed">Sim, o produto deve estar sem sinais de uso, com todas as etiquetas, acessórios, manual e na embalagem original.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Quem paga o frete da troca?</dt>
                            <dd class="text-gray-700 leading-relaxed">Por defeito de fabricação: nós arcamos com o frete. Por arrependimento/desistência (direito de arrependimento em 7 dias): nós arcamos. Por outros motivos (tamanho, cor, etc.): o frete é por conta do cliente.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Como solicito uma troca?</dt>
                            <dd class="text-gray-700 leading-relaxed">Acesse "Meu Perfil", selecione o pedido, clique em "Solicitar Troca" e preencha o formulário. Nossa equipe analisará em até 2 dias úteis.</dd>
                        </div>
                    </dl>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Conta e Segurança</h2>
                    <dl class="space-y-6">
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Meus dados estão seguros?</dt>
                            <dd class="text-gray-700 leading-relaxed">Sim. Utilizamos criptografia SSL/TLS, não armazenamos dados de cartão de crédito e senhas são protegidas com hash BCrypt.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Esqueci minha senha, como recupero?</dt>
                            <dd class="text-gray-700 leading-relaxed">Na tela de login, clique em "Esqueci minha senha" e informe seu e-mail. Enviaremos um link para redefinição.</dd>
                        </div>
                        <div>
                            <dt class="text-lg font-medium text-gray-900 mb-2">Posso excluir minha conta?</dt>
                            <dd class="text-gray-700 leading-relaxed">Sim, entre em contato com nosso suporte. A exclusão remove seus dados pessoais, mas mantemos registros de pedidos por obrigação legal.</dd>
                        </div>
                    </dl>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>