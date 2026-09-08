<?php
session_start();
$basePath = '../../../';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termos de Uso</title>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Termos de Uso</h1>
            <p class="text-gray-500 text-sm mb-8">Última atualização: <?= date('d/m/Y') ?></p>

            <div class="space-y-8 text-gray-700 leading-relaxed">
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Aceitação dos Termos</h2>
                    <p>Ao acessar e utilizar este site, você concorda em cumprir e estar vinculado a estes Termos de Uso. Se não concordar com qualquer parte, não utilize nossos serviços.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Definições</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>"Site", "Plataforma", "Loja":</strong> este e-commerce;</li>
                        <li><strong>"Usuário", "Cliente", "Você":</strong> pessoa que acessa ou compra no site;</li>
                        <li><strong>"Nós", "Nosso", "Empresa":</strong> proprietários e operadores da loja;</li>
                        <li><strong>"Conteúdo":</strong> textos, imagens, logos, códigos, design, produtos.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Cadastro e Conta</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Para comprar, você deve criar uma conta com informações verdadeiras e atualizadas;</li>
                        <li>Você é responsável por manter sua senha segura e por todas as atividades na sua conta;</li>
                        <li>Deve ter capacidade civil plena (maior de 18 anos ou emancipado);</li>
                        <li>Podemos suspender ou cancelar contas que violem estes termos.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Produtos e Preços</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Imagens são ilustrativas; cores e detalhes podem variar;</li>
                        <li>Preços e disponibilidade sujeitos a alteração sem aviso prévio;</li>
                        <li>Erros de digitação em preços: reservamo-nos o direito de cancelar o pedido;</li>
                        <li>Estoque é atualizado em tempo real, mas pode haver divergência momentânea.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Pedidos e Pagamento</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>O pedido é uma oferta de compra; o contrato se forma com a confirmação de pagamento;</li>
                        <li>Reservamo-nos o direito de recusar ou limitar quantidades por pessoa;</li>
                        <li>Pagamentos são processados por gateways certificados (PCI DSS);</li>
                        <li>Não armazenamos dados sensíveis de cartão de crédito.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">6. Propriedade Intelectual</h2>
                    <p>Todo o conteúdo do site (textos, imagens, logos, marcas, layout, código) é de nossa propriedade ou licenciado. É proibida a reprodução total ou parcial sem autorização prévia por escrito.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">7. Conduta do Usuário</h2>
                    <p>Você não deve:</p>
                    <ul class="list-disc list-inside space-y-2 mt-2">
                        <li>Usar o site para fins ilegais ou não autorizados;</li>
                        <li>Interferir na segurança, integridade ou desempenho do site;</li>
                        <li>Tentar acessar áreas restritas, bancos de dados ou código fonte;</li>
                        <li>Enviar vírus, malware, spam ou realizar engenharia reversa;</li>
                        <li>Fazer compras fraudulentas, de má-fé ou para revenda não autorizada.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">8. Limitação de Responsabilidade</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>O site é fornecido "como está", sem garantias de disponibilidade ininterrupta ou isenta de erros;</li>
                        <li>Não nos responsabilizamos por danos indiretos, lucros cessantes ou perda de dados;</li>
                        <li>Links para sites de terceiros não implicam endosso ou responsabilidade sobre seu conteúdo.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">9. Privacidade</h2>
                    <p>O tratamento dos seus dados pessoais segue nossa <a href="<?= $basePath ?>src/views/public/privacy.php" class="text-blue-600 hover:underline">Política de Privacidade</a>, que faz parte integrante destes termos.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">10. Alterações nos Termos</h2>
                    <p>Podemos atualizar estes termos a qualquer momento. A versão vigente estará sempre nesta página com a data de atualização. O uso contínuo após alterações constitui aceitação.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">11. Lei Aplicável e Foro</h2>
                    <p>Estes termos são regidos pelas leis da República Federativa do Brasil. Fica eleito o foro da Comarca de São Paulo/SP para dirimir quaisquer controvérsias, com renúncia a qualquer outro, por mais privilegiado que seja.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">12. Contato</h2>
                    <p>Dúvidas sobre estes termos: <a href="mailto:gl930551@gmail.com" class="text-blue-600 hover:underline">gl930551@gmail.com</a></p>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>