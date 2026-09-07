-- Master Seed File
-- Ordem correta respeitando foreign keys:
-- 1. categories (sem dependências)
-- 2. admins (sem dependências)
-- 3. clients (sem dependências)
-- 4. products (depende de categories)
-- 5. orders (depende de clients)
-- 6. order_items (depende de orders e products)

SOURCE seeds/categories/seed_categories.sql;
SOURCE seeds/admins/seed_admins.sql;
SOURCE seeds/clients/seed_clients.sql;
SOURCE seeds/products/seed_products.sql;
SOURCE seeds/orders/seed_orders.sql;
SOURCE seeds/order_items/seed_order_items.sql;