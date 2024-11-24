<?php
$order_id = $_GET['order_id'] ?? null;

$today = new DateTime();
$expected_delivery_date = $today->modify('+4 days')->format('d.m.Y');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank you for your order!</h1>
    <p>Your order has been successfully placed. Your order number is: <strong>#<?= htmlspecialchars($order_id) ?></strong>.</p>
    <p>Ihre Bestellung wird voraussichtlich am <strong><?= $expected_delivery_date ?></strong> bei Ihnen ankommen.</p>
</body>
</html>