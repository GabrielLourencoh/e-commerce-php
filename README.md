# E-commerce PHP + MySQL

Projeto de loja virtual desenvolvido em PHP puro com MySQL. Estrutura MVC (Models, Controllers, Views, DAOs).

---

## Estrutura do Projeto

```
e-commerce/
├── assets/
│   └── public/
│       └── images/
│           └── products/       # Imagens dos produtos (upload local)
├── config/
│   └── Connection.php          # Conexão PDO com MySQL
├── database/
│   ├── schema.sql              # Apenas CREATE TABLEs (estrutura pura)
│   └── seeds/                  # Dados iniciais (seeds) organizados por tabela
│       ├── seed_all.sql        # Master file - executa todos na ordem correta (FKs)
│       ├── categories/seed_categories.sql
│       ├── products/seed_products.sql
│       ├── clients/seed_clients.sql
│       ├── admins/seed_admins.sql
│       ├── orders/seed_orders.sql
│       └── order_items/seed_order_items.sql
├── src/
│   ├── controllers/            # Controladores
│   │   ├── admins/
│   │   │   ├── LoginController.php
│   │   │   └── LogoutController.php
│   │   ├── cart/
│   │   │   └── CartController.php
│   │   ├── categories/
│   │   │   └── CategoryController.php
│   │   ├── clients/
│   │   │   ├── ClientController.php
│   │   │   ├── LoginController.php
│   │   │   └── LogoutController.php
│   │   ├── orders/
│   │   │   └── OrderController.php
│   │   └── products/
│   │       └── ProductController.php
│   ├── dao/                    # Data Access Objects (CRUD no banco)
│   │   ├── admins/AdminDAO.php
│   │   ├── categories/CategoryDAO.php
│   │   ├── clients/ClientDAO.php
│   │   ├── orders/OrderDAO.php
│   │   └── products/ProductDAO.php
│   ├── models/                 # Classes que representam as entidades
│   │   ├── admins/Admin.php
│   │   ├── categories/Category.php
│   │   ├── clients/Client.php
│   │   └── products/Product.php
│   └── views/                  # Templates HTML + PHP
│       ├── admin/
│       │   ├── login.php
│       │   ├── dashboard.php
│       │   ├── categories/
│       │   │   ├── create.php
│       │   │   ├── index.php
│       │   │   └── update.php
│       │   ├── products/
│       │   │   ├── create.php
│       │   │   ├── index.php
│       │   │   └── update.php
│       │   ├── orders/
│       │   │   ├── index.php
│       │   │   └── view.php
│       │   └── clients/
│       │       ├── index.php
│       │       └── view.php
│       ├── public/
│       │   ├── cart.php              # Carrinho de compras
│       │   ├── login.php
│       │   ├── register.php
│       │   ├── profile.php
│       │   ├── faq.php               # Perguntas frequentes
│       │   ├── exchange-policy.php   # Política de troca e devolução
│       │   ├── shipping.php          # Frete e prazos
│       │   ├── terms.php             # Termos de uso
│       │   ├── privacy.php           # Política de privacidade (LGPD)
│       │   └── cookies.php           # Política de cookies
│       └── partials/
│           └── footer.php            # Rodapé compartilhado
└── index.php                   # Entry point - carrega catálogo
```

---

## Principais Funcionalidades Implementadas

### Área Pública (Cliente)

- **Catálogo de produtos** (`/`) — lista produtos ativos com imagem, nome, preço, categoria; busca via JOIN `products` + `categories`
- **Carrinho de compras** (`/src/views/public/cart.php`) — adiciona/remove/altera quantidade via AJAX; dados salvos em `$_SESSION['cart']`
- **Login/Cadastro de cliente** — senha com `password_hash`/`password_verify` (BCrypt); sessão guarda `client_id`, `client_name`
- **Cadastro com máscaras e autocomplete** — CPF (`000.000.000-00`), telefone (`(00) 00000-0000`), CEP (`00000-000`), UF (maiúsculo); **ViaCEP** preenche endereço/bairro/cidade/estado ao sair do campo CEP
- **Perfil do cliente** — visualiza e edita dados pessoais + endereço
- **Finalização de pedido** — cria registro em `orders` + itens em `order_items`; guarda `unit_price` no momento da compra (histórico imutável); limpa carrinho após sucesso
- **Páginas institucionais** — FAQ, Termos de uso, Política de privacidade (LGPD), Política de cookies, Frete e prazos, Política de troca e devolução; acessíveis via footer e header; sessão compartilhada para mostrar usuário logado

### Área Administrativa

- **Login separado** para admins (tabela `admins` independente de `clients`)
- **Dashboard** — visão geral
- **CRUD de Categorias** — create, list, update, delete
- **CRUD de Produtos** — create, list, update, delete; associação com categoria; controle de estoque; upload de imagem local (JPG, PNG, WebP, AVIF ≤ 2MB); nomes únicos automáticos; preview no update; soft delete preserva arquivo
- **Gestão de Pedidos** — lista todos; visualiza detalhes com itens; altera status (Pendente, Pago, Processando, Enviado, Entregue, Cancelado)

---

## Banco de Dados

### Estrutura (`database/schema.sql`)

Apenas `CREATE TABLE` — sem IDs explícitos (usa `AUTO_INCREMENT`), sem dados.

```sql
CREATE DATABASE IF NOT EXISTS ecommerce_db;
USE ecommerce_db;

-- 1. Categorias
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE
);

-- 2. Produtos (FK -> categories)
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT NOT NULL,
    name VARCHAR(150) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    image VARCHAR(255) NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_products_categories FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- 3. Clientes
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NULL UNIQUE,
    phone VARCHAR(15) NULL,
    address VARCHAR(200) NULL,
    number VARCHAR(10) NULL,
    complement VARCHAR(100) NULL,
    neighborhood VARCHAR(100) NULL,
    city VARCHAR(100) NULL,
    state CHAR(2) NULL,
    cep VARCHAR(9) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 4. Administradores
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- 5. Pedidos (FK -> clients)
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    order_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(30) NOT NULL DEFAULT 'Pendente',
    payment_method VARCHAR(50) NULL,
    transaction_code VARCHAR(100) NULL,
    CONSTRAINT fk_orders_clients FOREIGN KEY (client_id) REFERENCES clients(id)
);

-- 6. Itens do Pedido (FK -> orders + products)
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_items_orders FOREIGN KEY (order_id) REFERENCES orders(id),
    CONSTRAINT fk_items_products FOREIGN KEY (product_id) REFERENCES products(id)
);
```

### Seeds (`database/seeds/`)

Dados de exemplo organizados por tabela:

```
database/seeds/
├── seed_all.sql                    # Master - roda tudo na ordem (FKs primeiro)
├── categories/seed_categories.sql  # 10 categorias
├── products/seed_products.sql      # 5 produtos (com imagens locais)
├── clients/seed_clients.sql        # 10 clientes (senha = "password" hashed)
├── admins/seed_admins.sql          # 2 admins originais
├── orders/seed_orders.sql          # 10 pedidos com status variados
└── order_items/seed_order_items.sql # 11 itens
```

**Como popular o banco (via MySQL CLI):**

```bash
# 1. Cria estrutura
mysql -u root -p < database/schema.sql

# 2. Popula dados (ordem correta automática via master)
mysql -u root -p ecommerce_db < database/seeds/seed_all.sql
```

Ou abra `database/seeds/seed_all.sql` no MySQL Workbench e execute (⚡).

**Ou rode seed por seed na ordem de dependência (FKs primeiro) via terminal:**

```bash
mysql -u root -p ecommerce_db < database/seeds/categories/seed_categories.sql
mysql -u root -p ecommerce_db < database/seeds/products/seed_products.sql
mysql -u root -p ecommerce_db < database/seeds/clients/seed_clients.sql
mysql -u root -p ecommerce_db < database/seeds/admins/seed_admins.sql
mysql -u root -p ecommerce_db < database/seeds/orders/seed_orders.sql
mysql -u root -p ecommerce_db < database/seeds/order_items/seed_order_items.sql
```

**Ou abra cada arquivo no MySQL Workbench** (File → Open SQL Script → Execute ⚡) na mesma ordem acima.

**Dados incluídos:** 10 categorias, 5 produtos, 10 clientes, 2 admins, 10 pedidos, 11 itens.

---

## Seeds (Dados de Exemplo)

Localizados em `database/seeds/` — um arquivo por tabela + `seed_all.sql` master.

```bash
# Rodar tudo (ordem correta de FK)
mysql -u root -p ecommerce_db < database/seeds/seed_all.sql

# Ou rodar individualmente se precisar
mysql -u root -p ecommerce_db < database/seeds/categories/seed_categories.sql
mysql -u root -p ecommerce_db < database/seeds/products/seed_products.sql
# ...
```

**Produtos seedados (5) — imagens em `assets/public/images/products/`:**

- `notebook.webp` → Notebook Gamer RTX 4060
- `teclado.jpg` → Teclado Mecânico RGB Switch Blue
- `mouse.avif` → Mouse Gamer Sem Fio 16000 DPI
- `cadeira.webp` → Cadeira Gamer Ergonômica
- `pen-drive.avif` → Pen Drive 128GB USB 3.2

## Segurança: Hash de Senhas

- **Cadastro** (`ClientController.php`): `password_hash($_POST['password'], PASSWORD_DEFAULT)` → BCrypt custo 10
- **Login** (`ClientDAO::login()`): busca por email → `password_verify($input, $hash)`
- **Admins**: seeds atuais usam senha pura (`admin123`)

---

## Frontend: Máscaras & ViaCEP (`register.php`)

| Campo    | Máscara (jQuery, input event)         | Validação        |
| -------- | ------------------------------------- | ---------------- |
| CPF      | `000.000.000-00`                      | `maxlength="14"` |
| Telefone | `(00) 00000-0000` ou `(00) 0000-0000` | `maxlength="15"` |
| CEP      | `00000-000`                           | `maxlength="9"`  |
| UF       | `SP` (maiúsculo, 2 letras)            | `maxlength="2"`  |

**ViaCEP**: se 8 dígitos → `GET https://viacep.com.br/ws/{cep}/json/` → preenche endereço, bairro, cidade, estado automaticamente.

---

## Upload de Imagem de Produto (Admin)

**Fluxo:**

1. Admin acessa _Novo Produto_ ou _Editar Produto_
2. Seleciona arquivo no input `type="file"` (accept: `image/jpeg,image/png,image/webp,image/avif`)
3. Form envia `multipart/form-data` via AJAX (`FormData`)
4. `ProductController` valida:
   - Tipo MIME real via `finfo` (não confia na extensão)
   - Tamanho ≤ 2MB
5. Gera nome único: `produto_{timestamp}_{random}.{ext}`
6. Salva em `assets/public/images/products/`
7. Grava caminho relativo no banco: `assets/public/images/products/produto_1234567890_abcd.webp`
8. Catálogo público (`index.php`) usa `<img src="<?= $product['image'] ?>">` — caminho relativo à raiz funciona direto

**Atualização:** Se enviar nova imagem → apaga a antiga e substitui. Se deixar vazio → mantém a atual.

**Exclusão (soft delete):** Apenas seta `active=0` — **não apaga o arquivo** para permitir reativação com imagem intacta.

| Comando                         | O que faz                                                           | Exemplo no projeto                                                                      |
| ------------------------------- | ------------------------------------------------------------------- | --------------------------------------------------------------------------------------- |
| `CREATE DATABASE IF NOT EXISTS` | Cria o banco se não existir; evita erro se já houver                | `CREATE DATABASE IF NOT EXISTS ecommerce_db;`                                           |
| `USE`                           | Seleciona o banco ativo para os comandos seguintes                  | `USE ecommerce_db;`                                                                     |
| `CREATE TABLE`                  | Define uma nova tabela com colunas, tipos e restrições              | `CREATE TABLE products (...)`                                                           |
| `PRIMARY KEY`                   | Identificador único da linha (auto-incremento via `AUTO_INCREMENT`) | `id INT AUTO_INCREMENT PRIMARY KEY`                                                     |
| `FOREIGN KEY` + `REFERENCES`    | Cria relacionamento entre tabelas (integridade referencial)         | `CONSTRAINT fk_products_categories FOREIGN KEY (category_id) REFERENCES categories(id)` |
| `CONSTRAINT`                    | Nomeia a restrição (facilita debug/remoção posterior)               | `CONSTRAINT fk_orders_clients ...`                                                      |
| `NOT NULL`                      | Obriga preenchimento do campo                                       | `name VARCHAR(150) NOT NULL`                                                            |
| `UNIQUE`                        | Impede valores duplicados na coluna                                 | `email VARCHAR(150) NOT NULL UNIQUE`                                                    |
| `DEFAULT`                       | Valor automático se não informado no INSERT                         | `active BOOLEAN NOT NULL DEFAULT TRUE`                                                  |
| `AUTO_INCREMENT`                | Gera ID sequencial automaticamente no INSERT                        | `id INT AUTO_INCREMENT PRIMARY KEY`                                                     |
| `DEFAULT CURRENT_TIMESTAMP`     | Preenche data/hora atual no INSERT                                  | `created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP`                                |
| `DECIMAL(10,2)`                 | Precisão fixa para valores monetários (10 dígitos, 2 casas)         | `price DECIMAL(10, 2) NOT NULL`                                                         |
| `INSERT INTO ... VALUES`        | Insere registros iniciais (seed)                                    | `INSERT INTO categories (name, ...) VALUES ('Eletrônicos', ...)`                        |

**Dicas do schema:**

- `unit_price` em `order_items` congela o preço no momento da compra (não muda se o produto for reajustado depois)
- `active` (boolean) permite "soft delete" — o registro fica no banco mas não aparece no catálogo/admin
- Chaves estrangeiras nomeadas (`fk_products_categories`, `fk_orders_clients`, etc.) ajudam a identificar erros de constraint no log

---

## Como Rodar o Projeto

### Opção 1 — PHP Built-in Server (rápido, sem XAMPP)

> Requer PHP ≥ 7.4 instalado e no PATH do Windows.

```bash
# 1. Clone/abra a pasta do projeto
cd C:\xampp\htdocs\ETEC\PWIII\e-commerce

# 2. Crie o banco e tabelas (MySQL precisa estar rodando)
mysql -u root -p < database/schema.sql

# 3. Popule com dados de exemplo (seeds)
mysql -u root -p ecommerce_db < database/seeds/seed_all.sql

# 4. Ajuste config/Connection.php se suas credenciais forem diferentes:
#    private $host = "localhost";
#    private $banco = "ecommerce_db";
#    private $usuario = "root";
#    private $senha = "";        # senha do seu MySQL (vazio no XAMPP padrão)
#    private $porta = "3306";

# 5. Suba o servidor embutido na pasta raiz
php -S localhost:8000

# 6. Acesse no navegador
#    http://localhost:8000           → catálogo (index.php)
#    http://localhost:8000/src/views/admin/login.php  → painel admin
```

---

### Opção 2 — XAMPP + MySQL Workbench (ambiente completo)

> Ideal se você já usa XAMPP no dia a dia.

**Passo a passo:**

1. **Instale/abra o XAMPP Control Panel**
   - Inicie **Apache** e **MySQL** (botão _Start_ nas duas linhas)
   - Verifique se as portas padrão estão livres: Apache 80/443, MySQL 3306

2. **Copie o projeto para `htdocs` do XAMPP** (se ainda não está lá)

   ```
   C:\xampp\htdocs\ecommerce
   ```

3. **Crie o banco via MySQL Workbench**
   - Abra o **MySQL Workbench**
   - Conexão: `Local Instance 3306` (usuário `root`, senha vazia por padrão)
   - Menu _File_ → _Open SQL Script_ → selecione `database/schema.sql`
   - Clique no raio (⚡) _Execute_ ou `Ctrl+Shift+Enter`
   - Menu _File_ → _Open SQL Script_ → selecione `database/seeds/seed_all.sql`
   - Execute novamente (⚡)
   - Verifique no painel _Schemas_ → `ecommerce_db` → _Tables_: devem aparecer 6 tabelas com dados

4. **Confira/ajuste a conexão em `config/Connection.php`**

   ```php
   private $host = "localhost";
   private $banco = "ecommerce_db";
   private $usuario = "root";
   private $senha = "";        // XAMPP padrão = vazio
   private $porta = "3306";
   ```

5. **Acesse pelo Apache do XAMPP**
   - URL base: `http://localhost/ecommerce/` (ou o nome da pasta que você usou)
   - Catálogo: `http://localhost/ecommerce/`
   - Admin: `http://localhost/ecommerce/src/views/admin/login.php`
   - Login admin: `admin@loja.com` / `admin123`
   - Login cliente (seeds): `joao@email.com` / `password`

**Dica:** Se der erro 404 no admin, verifique se o Apache está servindo a pasta correta (DocumentRoot do XAMPP aponta para `C:\xampp\htdocs`).

---

## Configuração Rápida de Credenciais

Se seu MySQL tem senha no `root` (não padrão do XAMPP), edite apenas `config/Connection.php`:

```php
private $senha = "sua_senha_aqui";
```

O resto (host, porta, banco, usuário) costuma funcionar como está.

---

## Tecnologias

- **PHP 7.4+** — linguagem principal
- **MySQL 5.7+/8.0** — banco de dados relacional
- **Tailwind CSS (CDN)** — utilitários de estilo, responsivo mobile-first
- **jQuery (CDN)** — AJAX simples no carrinho, exclusões admin, máscaras e ViaCEP
- **password_hash / password_verify** — BCrypt nativo do PHP para senhas
- **ViaCEP API** — autocomplete de endereço via CEP (gratuito, sem chave)
