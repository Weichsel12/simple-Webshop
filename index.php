<?php
include 'db.php';

$query = "SELECT * FROM products";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Webshop</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Styling for the main heading */
        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Container for all products */
        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        /* Individual product card */
        .product-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 200px;
            text-align: center;
            padding: 15px;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: scale(1.05);
        }

        /* Styling for the product image */
        .product-card img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            transition: opacity 0.2s;
        }

        .product-card img:hover {
            opacity: 0.8;
        }

        /* Styling for product name */
        .product-card h2 {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }

        /* Styling for product description and price */
        .product-card p {
            color: #666;
            font-size: 0.9em;
            margin: 5px 0;
        }

        .product-card .price {
            font-weight: bold;
            color: #2a9d8f;
        }

        /* Link styling */
        a {
            text-decoration: none;
            color: inherit;
        }

        footer {
        background-color: #333;
        color: white;
        text-align: center;
        padding: 15px;
        width: 100%;
        position: fixed;
        bottom: 0; /* Fixiert den Footer am unteren Rand des Bildschirms */
        left: 0;
        z-index: 10; /* Stellt sicher, dass der Footer immer über dem Inhalt bleibt */
        }

        footer a {
            color: white;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
        </style>
    </head>
    <body>
    <h1>Products</h1>
    <div class="products-container">
        <?php while ($product = $result->fetch_assoc()): ?>
            <div class="product-card">
                <a href="product.php?product_id=<?= htmlspecialchars(string: $product['product_id']) ?>">
                    <h2><?= htmlspecialchars(string: $product['product_name']) ?></h2>
                    <!-- Make the image clickable to open the product details page -->
                    <img src="<?= htmlspecialchars($product['image_url']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
              
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p class="price">Price: €<?= htmlspecialchars($product['price']) ?></p>
                  </a>
            </div>
        <?php endwhile; ?>
    </div>
    </body>

    <footer>
        <a href="Logout.php">Logout</a>
    </footer>
</html>