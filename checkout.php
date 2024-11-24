<?php
session_start();
include 'db.php';

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_SESSION['cart'])) {
        // Loop through the cart items and insert each into the orders table
        foreach ($_SESSION['cart'] as $item) {
            $product_id = $item['pid'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $user_id = $_SESSION['user_id'];
            $quantity = $item['quantity'];
            

            $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, datum, preis, quantity) VALUES (?, ?, NOW(), ?, ?)");
            $stmt->bind_param("iiii", $user_id, $product_id, $price, $quantity);
            $stmt->execute();

            // Optional: Get the last inserted order ID if needed for further operations
            $order_id = $conn->insert_id;
        }

        // Clear the cart after the order is placed
        unset($_SESSION['cart']);

        // Redirect to a confirmation page
        header("Location: abschluss.php?order_id=$order_id");
        exit();
    }
}
?>
