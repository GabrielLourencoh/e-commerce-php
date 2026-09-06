-- Seed Orders
INSERT INTO orders (client_id, order_date, total_amount, status, payment_method, transaction_code) VALUES 
(1, '2024-01-15 10:30:00', 489.80, 'Entregue', 'Cartão de Crédito', 'TXN001'),
(2, '2024-01-16 14:20:00', 299.00, 'Entregue', 'Pix', 'TXN002'),
(3, '2024-01-17 09:15:00', 189.99, 'Enviado', 'Boleto', 'TXN003'),
(4, '2024-01-18 16:45:00', 379.80, 'Pago', 'Cartão de Crédito', 'TXN004'),
(5, '2024-01-19 11:00:00', 129.90, 'Processando', 'Pix', 'TXN005'),
(6, '2024-01-20 13:30:00', 549.90, 'Pendente', 'Cartão de Crédito', 'TXN006'),
(7, '2024-01-21 10:00:00', 219.90, 'Cancelado', 'Boleto', 'TXN007'),
(8, '2024-01-22 15:20:00', 899.90, 'Entregue', 'Pix', 'TXN008'),
(9, '2024-01-23 08:45:00', 149.90, 'Enviado', 'Cartão de Crédito', 'TXN009'),
(10, '2024-01-24 12:10:00', 349.90, 'Pago', 'Pix', 'TXN010');