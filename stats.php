<?php
include 'db.php';

// Least ordered products
$query = "SELECT product_name, total_orders FROM statistics ORDER BY total_orders ASC LIMIT 5";
$least_ordered = $conn->query($query);

// Most ordered products
$query = "SELECT product_name, total_orders FROM statistics ORDER BY total_orders DESC LIMIT 5";
$most_ordered = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Statistics</title>
</head>
<body>
    <h1>Statistics</h1>

    <h2>Least Ordered Products</h2>
    <?php while ($product = $least_ordered->fetch_assoc()): ?>
        <p><?= $product['product_name'] ?> - Orders: <?= $product['total_orders'] ?></p>
    <?php endwhile; ?>

    <h2>Most Ordered Products</h2>
    <?php while ($product = $most_ordered->fetch_assoc()): ?>
        <p><?= $product['product_name'] ?> - Orders: <?= $product['total_orders'] ?></p>
    <?php endwhile; ?>
</body>
</html>
