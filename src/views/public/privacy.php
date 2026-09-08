<?php
session_start();
$basePath = '../../../';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Política de Privacidade</title>
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
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Política de Privacidade</h1>
            <p class="text-gray-500 text-sm mb-8">Última atualização: <?= date('d/m/Y') ?> | Em conformidade com a LGPD (Lei 13.709/2018)</p>

            <div class="space-y-8 text-gray-700 leading-relaxed">
                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">1. Controlador dos Dados</h2>
                    <p><strong>E-commerce</strong> (nome fantasia), inscrito no CNPJ sob o nº 00.000.000/0001-00, com sede em São Paulo/SP, é o controlador dos seus dados pessoais. Contato do Encarregado (DPO): <a href="mailto:gl930551@gmail.com" class="text-blue-600 hover:underline">gl930551@gmail.com</a></p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">2. Dados Coletados</h2>
                    <h3 class="text-lg font-medium text-gray-800 mb-2">Dados de Identificação (Cadastro)</h3>
                    <ul class="list-disc list-inside space-y-1 mb-4">
                        <li>Nome completo</li>
                        <li>E-mail</li>
                        <li>CPF</li>
                        <li>Telefone</li>
                        <li>Endereço completo (rua, número, complemento, bairro, cidade, estado, CEP)</li>
                    </ul>

                    <h3 class="text-lg font-medium text-gray-800 mb-2">Dados de Autenticação</h3>
                    <ul class="list-disc list-inside space-y-1 mb-4">
                        <li>Senha (armazenada apenas como hash BCrypt, irrecuperável)</li>
                        <li>Tokens de sessão</li>
                    </ul>

                    <h3 class="text-lg font-medium text-gray-800 mb-2">Dados de Navegação (Automáticos)</h3>
                    <ul class="list-disc list-inside space-y-1 mb-4">
                        <li>Endereço IP</li>
                        <li>Tipo e versão do navegador</li>
                        <li>Sistema operacional</li>
                        <li>Páginas visitadas, tempo de permanência, cliques</li>
                        <li>Cookies (ver <a href="<?= $basePath ?>src/views/public/cookies.php" class="text-blue-600 hover:underline">Política de Cookies</a>)</li>
                    </ul>

                    <h3 class="text-lg font-medium text-gray-800 mb-2">Dados de Transação</h3>
                    <ul class="list-disc list-inside space-y-1 mb-4">
                        <li>Histórico de pedidos</li>
                        <li>Produtos visualizados/comprados</li>
                        <li>Forma de pagamento (dados sensíveis processados apenas pelo gateway, não armazenados por nós)</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">3. Finalidades e Bases Legais (LGPD Art. 7º)</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm border border-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Finalidade</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Base Legal</th>
                                    <th class="px-4 py-3 text-left font-semibold text-gray-800 border-b border-gray-200">Dados</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr><td class="px-4 py-3">Cadastro e gestão de conta</td><td class="px-4 py-3">Execução de contrato (Art. 7º, V)</td><td class="px-4 py-3">Identificação, contato, endereço</td></tr>
                                <tr><td class="px-4 py-3">Processamento de pedidos e entrega</td><td class="px-4 py-3">Execução de contrato (Art. 7º, V)</td><td class="px-4 py-3">Identificação, endereço, telefone</td></tr>
                                <tr><td class="px-4 py-3">Comunicação sobre pedidos (e-mail/SMS)</td><td class="px-4 py-3">Execução de contrato / Legítimo interesse (Art. 7º, V, IX)</td><td class="px-4 py-3">E-mail, telefone</td></tr>
                                <tr><td class="px-4 py-3">Marketing promocional (newsletter)</td><td class="px-4 py-3">Consentimento (Art. 7º, I)</td><td class="px-4 py-3">E-mail, nome</td></tr>
                                <tr><td class="px-4 py-3">Análise de navegação e melhoria do site</td><td class="px-4 py-3">Legítimo interesse (Art. 7º, IX)</td><td class="px-4 py-3">IP, navegador, páginas, cookies</td></tr>
                                <tr><td class="px-4 py-3">Prevenção de fraude e segurança</td><td class="px-4 py-3">Legítimo interesse / Obrigação legal (Art. 7º, IX, II)</td><td class="px-4 py-3">IP, dispositivo, comportamento</td></tr>
                                <tr><td class="px-4 py-3">Cumprimento de obrigações fiscais/contábeis</td><td class="px-4 py-3">Obrigação legal (Art. 7º, II)</td><td class="px-4 py-3">Dados de transação, CPF, notas fiscais</td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">4. Compartilhamento de Dados</h2>
                    <p>Seus dados podem ser compartilhados com:</p>
                    <ul class="list-disc list-inside space-y-2 mt-2">
                        <li><strong>Transportadoras/Correios:</strong> nome, endereço, telefone (para entrega);</li>
                        <li><strong>Gateways de pagamento:</strong> dados necessários para processamento (não recebemos dados sensíveis de cartão);</li>
                        <li><strong>Autoridades judiciais/administrativas:</strong> mediante ordem legal;</li>
                        <li><strong>Prestadores de serviço (hospedagem, e-mail, analytics):</strong> apenas o necessário, sob contrato de confidencialidade.</li>
                    </ul>
                    <p class="mt-2">Não vendemos, alugamos ou comercializamos seus dados pessoais.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">5. Retenção e Exclusão</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li><strong>Dados de cadastro e pedidos:</strong> mantidos enquanto a conta estiver ativa + 5 anos após último pedido (obrigação fiscal/contábil);</li>
                        <li><strong>Logs de navegação/IP:</strong> 12 meses;</li>
                        <li><strong>Dados de marketing:</strong> até revogação do consentimento;</li>
                        <li><strong>Exclusão da conta:</strong> anonimizamos dados que não precisamos reter por lei.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">6. Seus Direitos (LGPD Art. 18)</h2>
                    <p>Você pode solicitar a qualquer momento:</p>
                    <ul class="list-disc list-inside space-y-2 mt-2">
                        <li>Confirmação de tratamento e acesso aos dados;</li>
                        <li>Correção de dados incompletos, inexatos ou desatualizados;</li>
                        <li>Anonimização, bloqueio ou eliminação de dados desnecessários/excessivos;</li>
                        <li>Portabilidade dos dados a outro fornecedor;</li>
                        <li>Eliminação dos dados tratados com consentimento (exceto se houver base legal para retenção);</li>
                        <li>Informação sobre entidades com quem compartilhamos;</li>
                        <li>Informação sobre a possibilidade de não fornecer consentimento e consequências;</li>
                        <li>Revogação do consentimento.</li>
                    </ul>
                    <p class="mt-2">Para exercer seus direitos, envie e-mail para <a href="mailto:gl930551@gmail.com" class="text-blue-600 hover:underline">gl930551@gmail.com</a> com assunto "LGPD - Direitos do Titular". Responderemos em até 15 dias.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">7. Segurança</h2>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Criptografia SSL/TLS em todas as páginas (HTTPS);</li>
                        <li>Senhas com hash BCrypt (custo 10), nunca armazenadas em texto puro;</li>
                        <li>Acesso restrito aos dados (princípio do menor privilégio);</li>
                        <li>Monitoramento de acessos suspeitos;</li>
                        <li>Backup criptografado e testado periodicamente.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">8. Transferência Internacional</h2>
                    <p>Não realizamos transferência internacional de dados pessoais. Nossos servidores e parceiros estão localizados no Brasil.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">9. Menores de Idade</h2>
                    <p>Não coletamos intencionalmente dados de menores de 18 anos. Se você é pai/mãe/responsável e acredita que seu filho nos forneceu dados, entre em contato para remoção.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">10. Alterações nesta Política</h2>
                    <p>Atualizações serão publicadas nesta página com nova data. Alterações substanciais serão comunicadas por e-mail. Recomendamos revisão periódica.</p>
                </section>

                <section>
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">11. Contato do Encarregado (DPO)</h2>
                    <p>Dúvidas, reclamações ou exercício de direitos: <a href="mailto:gl930551@gmail.com" class="text-blue-600 hover:underline">gl930551@gmail.com</a> | Assunto: "LGPD"</p>
                </section>
            </div>
        </div>
    </main>

    <?php require_once __DIR__ . '/../partials/footer.php'; ?>
</body>
</html>