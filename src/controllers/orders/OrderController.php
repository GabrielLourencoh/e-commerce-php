<?php
    session_start();

    require_once __DIR__ . '/../../dao/orders/OrderDAO.php';
    require_once __DIR__ . '/../../dao/products/ProductDAO.php';    

    if (!isset($_SESSION['client_id'])) {
        echo "Faça login para finalizar a compra.";
        exit;
    }

    if (empty($_SESSION['cart'])) {
        echo "Seu carrinho está vazio.";
        exit;
    }

    $clientId = $_SESSION['client_id'];
    $paymentMethod = $_POST['payment_method'] ?? 'Cartão de Crédito';

    $productDAO = new ProductDAO();
    $orderDAO = new OrderDAO();

    // Calcula o total do pedido
    $totalAmount = 0;
    $itemsToInsert = [];

    foreach ($_SESSION['cart'] as $productId => $quantity) {
        $product = $productDAO->getById($productId);
        if ($product && $product['active'] == 1) {
            $subtotal = $product['price'] * $quantity;
            $totalAmount += $subtotal;

            $itemsToInsert[] = [
                'product_id' => $product['id'],
                'quantity'   => $quantity,
                'unit_price' => $product['price'],
                'subtotal'   => $subtotal
            ];
        }
    }

    // Cria o Pedido na tabela `orders`
    $orderId = $orderDAO->createOrder($clientId, $totalAmount, $paymentMethod);

    if ($orderId) {
        // Insere cada item na tabela `order_items`
        foreach ($itemsToInsert as $item) {
            $orderDAO->createOrderItem(
                $orderId, 
                $item['product_id'], 
                $item['quantity'], 
                $item['unit_price'], 
                $item['subtotal']
            );
        }

        // Limpa o carrinho da sessão
        unset($_SESSION['cart']);

        echo "sucesso";
    } else {
        echo "Erro ao salvar o pedido.";
    }

?>