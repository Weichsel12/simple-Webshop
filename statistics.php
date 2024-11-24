<?php
include 'db.php';

// Five Most Frequently Ordered Products
$query_highesttotalquantity = "
  SELECT product_id, SUM(quantity) AS total_quantity
FROM orders
GROUP BY product_id
ORDER BY total_quantity DESC
LIMIT 5

";
$highesttotalquantity = $conn->query($query_highesttotalquantity);

// Five Products with the Highest Number of Orders regardless of quantity.
$query_highesnumb = "
    SELECT product_id, COUNT(order_id) AS order_count
FROM orders
GROUP BY product_id
ORDER BY order_count DESC
LIMIT 5  
";
$highesnumb = $conn->query($query_highesnumb);

// Five least Frequently Ordered Products
$query_lowest5 = "
  SELECT product_id, SUM(quantity) AS total_quantity
FROM orders
GROUP BY product_id
ORDER BY total_quantity ASC
LIMIT 5

";
$lowest5 = $conn->query($query_lowest5);

//Order History Over the Last Four Weeks
$query_last4weeks = "
SELECT YEARWEEK(datum, 1) AS week, SUM(quantity) AS total_quantity
FROM orders
WHERE datum >= CURDATE() - INTERVAL 4 WEEK
GROUP BY week
ORDER BY week DESC;

";
$last4weeks = $conn->query($query_last4weeks);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h1, h2 {
            color: #333;
        }
        .stat-section {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Admin Statistics</h1>

    <div class="stat-section">
        <h2>Five Most Frequently Ordered Products</h2>
        <?php while ($product = $highesttotalquantity->fetch_assoc()): ?>
            <p>Product ID: <?= htmlspecialchars($product['product_id']) ?> - Total Quantity: <?= htmlspecialchars($product['total_quantity']) ?></p>
        <?php endwhile; ?>
    </div>

    <div class="stat-section">
        <h2>Five Products with the Highest Number of Orders</h2>
        <?php while ($product = $highesnumb->fetch_assoc()): ?>
            <p>Product ID: <?= htmlspecialchars($product['product_id']) ?> - Order Count: <?= htmlspecialchars($product['order_count']) ?></p>
        <?php endwhile; ?>
    </div>

    <div class="stat-section">
        <h2>Five Least Frequently Ordered Products</h2>
        <?php while ($product = $lowest5->fetch_assoc()): ?>
            <p>Product ID: <?= htmlspecialchars($product['product_id']) ?> - Total Quantity: <?= htmlspecialchars($product['total_quantity']) ?></p>
        <?php endwhile; ?>
    </div>

    <div class="stat-section">
        <h2>Order History Over the Last Four Weeks</h2>
        <?php while ($week = $last4weeks->fetch_assoc()): ?>
            <p>Week: <?= htmlspecialchars($week['week']) ?> - Total Quantity Ordered: <?= htmlspecialchars($week['total_quantity']) ?></p>
        <?php endwhile; ?>
    </div>
</body>
</html>