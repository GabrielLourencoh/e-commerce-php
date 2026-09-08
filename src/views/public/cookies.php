<?php
session_start();
$basePath = '../../../';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Cookies</title>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Política de Cookies</h1>
            <p class="text-gray-500 text-sm mb-8">Última atualização: <?= date('d/m/Y') ?></p>

            <div class="space-y-8 text-gray-700 leading-relaxed">
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">1. O que são Cookies</h2>
                    <p>Cookies são pequenos arquivos de texto armazenados no seu dispositivo (computador, celular, tablet) quando você visita um site. Eles permitem que o site "lembre" suas ações e preferências ao longo do tempo.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Tipos de Cookies que Utilizamos</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Categoria</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Finalidade</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Exemplos</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Duração</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Essenciais (Necessários)</td>
                                    <td class="px-4 py-3">Permitem o funcionamento básico do site: login, carrinho, sessão, segurança.</td>
                                    <td class="px-4 py-3">session_id, cart_token, csrf_token</td>
                                    <td class="px-4 py-3">Sessão / 1 ano</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Funcionais</td>
                                    <td class="px-4 py-3">Memorizam preferências: idioma, região, moeda, itens vistos recentemente.</td>
                                    <td class="px-4 py-3">locale, currency, recent_products</td>
                                    <td class="px-4 py-3">1 ano</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Analíticos / Desempenho</td>
                                    <td class="px-4 py-3">Coletam dados anônimos de uso para melhorar o site (páginas visitadas, erros, tempo).</td>
                                    <td class="px-4 py-3">_ga, _gid (Google Analytics)</td>
                                    <td class="px-4 py-3">2 anos / 24h</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">Marketing / Publicidade</td>
                                    <td class="px-4 py-3">Rastreiam navegação para exibir anúncios relevantes em outros sites (retargeting).</td>
                                    <td class="px-4 py-3">_fbp (Meta), IDE (Google Ads)</td>
                                    <td class="px-4 py-3">3 meses / 13 meses</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Cookies de Terceiros</h2>
                    <p>Podemos permitir que terceiros coloquem cookies no seu dispositivo para:</p>
                    <ul class="list-disc list-inside space-y-2 mt-2">
                        <li><strong>Google Analytics:</strong> análise de tráfego e comportamento (dados anonimizados, IP mascarado);</li>
                        <li><strong>Meta Pixel (Facebook/Instagram):</strong> medição de conversões e públicos para anúncios;</li>
                        <li><strong>Google Ads:</strong> remarketing e conversões;</li>
                        <li><strong>Gateways de pagamento:</strong> prevenção de fraude (ex: Mercado Pago, PagSeguro).</li>
                    </ul>
                    <p class="mt-2">Esses terceiros têm suas próprias políticas de privacidade. Recomendamos consultá-las.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Gerenciamento de Cookies</h2>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Pelo Navegador</h3>
                    <p>Você pode configurar seu navegador para:</p>
                    <ul class="list-disc list-inside space-y-1 mt-2 mb-4">
                        <li>Bloquear todos os cookies;</li>
                        <li>Bloquear apenas cookies de terceiros;</li>
                        <li>Excluir cookies existentes;</li>
                        <li>Receber aviso antes de aceitar cookies.</li>
                    </ul>
                    <p class="text-sm text-gray-600"><strong>Links úteis:</strong> <a href="https://support.google.com/chrome/answer/95647" target="_blank" class="text-blue-600 hover:underline">Chrome</a> | <a href="https://support.mozilla.org/pt-BR/kb/ative-e-desative-os-cookies" target="_blank" class="text-blue-600 hover:underline">Firefox</a> | <a href="https://support.apple.com/pt-br/guide/safari/sfri11471/mac" target="_blank" class="text-blue-600 hover:underline">Safari</a> | <a href="https://support.microsoft.com/pt-br/microsoft-edge/excluir-cookies-no-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" class="text-blue-600 hover:underline">Edge</a></p>

                    <h3 class="text-lg font-medium text-gray-800 mb-2">Opt-out de Publicidade</h3>
                    <ul class="list-disc list-inside space-y-1">
                        <li><a href="https://www.google.com/settings/ads" target="_blank" class="text-blue-600 hover:underline">Google Ads Settings</a></li>
                        <li><a href="https://www.facebook.com/ads/preferences" target="_blank" class="text-blue-600 hover:underline">Meta Ad Preferences</a></li>
                        <li><a href="https://optout.aboutads.info/" target="_blank" class="text-blue-600 hover:underline">Network Advertising Initiative</a></li>
                        <li><a href="https://optout.networkadvertising.org/" target="_blank" class="text-blue-600 hover:underline">Digital Advertising Alliance</a></li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Cookies Específicos deste Site</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Nome</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Tipo</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Finalidade</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Expiração</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr><td class="px-4 py-3 font-mono text-gray-900">PHPSESSID</td><td class="px-4 py-3">Essencial</td><td class="px-4 py-3">Identifica sessão do usuário no servidor</td><td class="px-4 py-3">Sessão</td></tr>
                                <tr><td class="px-4 py-3 font-mono text-gray-900">cart_token</td><td class="px-4 py-3">Essencial</td><td class="px-4 py-3">Mantém itens do carrinho entre páginas</td><td class="px-4 py-3">30 dias</td></tr>
                                <tr><td class="px-4 py-3 font-mono text-gray-900">remember_token</td><td class="px-4 py-3">Essencial</td><td class="px-4 py-3">Login "Lembrar-me" (se implementado)</td><td class="px-4 py-3">1 ano</td></tr>
                                <tr><td class="px-4 py-3 font-mono text-gray-900">cookie_consent</td><td class="px-4 py-3">Funcional</td><td class="px-4 py-3">Registra aceitação do banner de cookies</td><td class="px-4 py-3">1 ano</td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">6. Consentimento</h2>
                    <p>Ao continuar navegando neste site após visualizado o banner de cookies, você consente com o uso de cookies conforme esta política. Cookies essenciais não requerem consentimento (base legal: execução de contrato / legítimo interesse).</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">7. Impacto da Desativação</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Essenciais desativados:</strong> site não funcionará (login, carrinho, checkout);</li>
                        <li><strong>Funcionais desativados:</strong> preferências não serão salvas;</li>
                        <li><strong>Analíticos/Marketing desativados:</strong> site funciona normalmente, apenas não coletamos métricas nem exibimos anúncios personalizados.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">8. Alterações</h2>
                    <p>Esta política pode ser atualizada. Verifique a data no topo. Alterações significativas serão notificadas via banner no site.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">9. Contato</h2>
                    <p>Dúvidas sobre cookies: <a href="mailto:gl930551@gmail.com" class="text-blue-600 hover:underline">gl930551@gmail.com</a></p>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>