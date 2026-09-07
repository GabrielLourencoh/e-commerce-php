-- Seed Orders (totais batendo com order_items)
INSERT INTO orders (client_id, order_date, total_amount, status, payment_method, transaction_code) VALUES 
(1, '2024-01-15 10:30:00', 5249.80, 'Entregue', 'Cartão de Crédito', 'TXN001'),
(2, '2024-01-16 14:20:00', 189.90, 'Entregue', 'Pix', 'TXN002'),
(3, '2024-01-17 09:15:00', 1299.90, 'Enviado', 'Boleto', 'TXN003'),
(4, '2024-01-18 16:45:00', 79.90, 'Pago', 'Cartão de Crédito', 'TXN004'),
(5, '2024-01-19 11:00:00', 699.80, 'Processando', 'Pix', 'TXN005'),
(6, '2024-01-20 13:30:00', 4899.90, 'Pendente', 'Cartão de Crédito', 'TXN006'),
(7, '2024-01-21 10:00:00', 189.90, 'Cancelado', 'Boleto', 'TXN007'),
(8, '2024-01-22 15:20:00', 1299.90, 'Entregue', 'Pix', 'TXN008'),
(9, '2024-01-23 08:45:00', 159.80, 'Enviado', 'Cartão de Crédito', 'TXN009'),
(10, '2024-01-24 12:10:00', 349.90, 'Pago', 'Pix', 'TXN010');