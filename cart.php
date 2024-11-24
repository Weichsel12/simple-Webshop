<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Warenkorb</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .cart-container {
            width: 100%;
            max-width: 600px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: left;
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .cart-item p {
            margin: 0;
        }

        .total {
            font-weight: bold;
            font-size: 1.2em;
            color: #333;
            margin-top: 20px;
            text-align: right;
        }

        /* Styling for the checkout button */
        .checkout-button {
            background-color: #2a9d8f;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            text-align: center;
            transition: background 0.3s ease;
        }

        .checkout-button:hover {
            background-color: #21867a;
        }
    </style>
</head>
<body>
    <h1>Warenkorb</h1>
    <div class="cart-container">
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php $total = 0; ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="cart-item">
                    <p><?= htmlspecialchars($item['product_name']) ?> (x<?= htmlspecialchars($item['quantity']) ?>)</p>
                    <p>€<?= htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)) ?></p>
                </div>
                <?php $total += $item['price'] * $item['quantity']; ?>
            <?php endforeach; ?>
            <p class="total">Gesamt: €<?= htmlspecialchars(number_format($total, 2)) ?></p>

            <!-- Checkout button to proceed to the checkout page -->
            <form action="payment.php" method="post">
                <button type="submit" class="checkout-button">Zur Kasse</button>
            </form>

        <?php else: ?>
            <p>Ihr Warenkorb ist leer.</p>
        <?php endif; ?>
    </div>
</body>
</html>
