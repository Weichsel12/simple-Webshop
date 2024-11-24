<?php
session_start();
include 'db.php';

// Check if a product_id is set in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Prepare and execute query to fetch product details
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // If product not found, redirect to the main page
    if (!$product) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

// Handle the add to cart functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantity = isset($_POST['anzahl']) ? (int)$_POST['anzahl'] : 1;

    // Ensure a valid quantity is added
    if ($quantity > 0) {
        // Add to cart (store in session)
        $_SESSION['cart'][$product_id] = [
            'product_name' => $product['product_name'],
            'price' => $product['price'],
            'quantity' => $quantity,
            'pid' => $product_id
        ];

        // Redirect to the cart page or display success message
        header(header: "Location: cart.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($product['product_name']) ?> - Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .product-detail {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            text-align: center;
        }

        .product-detail img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .product-detail h2 {
            color: #333;
            margin-bottom: 10px;
        }

        .product-detail p {
            color: #666;
            margin-bottom: 10px;
        }

        .product-detail .price {
            font-weight: bold;
            color: #2a9d8f;
            font-size: 1.2em;
            margin-top: 10px;
        }
.addtocart
{
    color:#2a9d8f;
    background-color: white;
    border-color:#2a9d8f ;
    border-width: 2px;
    font-weight: bold;
}

.anzahl
{
    background-color: white;
    border-color:#2a9d8f ;
    color:#2a9d8f;
    border-width: 2px;
    font-weight: bold;
    text-align: center;
    
}
        

     
    </style>
</head>
<body>
    <div class="product-detail">
        <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
        <h2><?= htmlspecialchars($product['product_name']) ?></h2>
        <p><?= htmlspecialchars($product['description']) ?></p>
        <p class="price">Price: €<?= htmlspecialchars($product['price']) ?></p>
        <form method="post">
            <input type="number" name="anzahl" value="1" min="1" placeholder="Anzahl" class="anzahl">
            <br>
            <br>
            <button type="submit" class="addtocart">In den Warenkorb</button>
        </form>
    </div>
</body>
</html>
