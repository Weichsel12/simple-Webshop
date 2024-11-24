<?php
include 'db.php';

// Delete Product
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "Product deleted successfully!";
}

// Edit Product
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $code = $_POST['code'];
    $image = 'path/to/image.jpg';

    $stmt = $conn->prepare("UPDATE products SET product_name = ?, description = ?, price = ?, product_code = ?, image_url = ? WHERE product_id = ?");
    $stmt->bind_param("ssdssi", $name, $description, $price, $code, $image, $id);
    $stmt->execute();
    echo "Product updated successfully!";
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $code = $_POST['code'];
    $image = 'path/to/image.jpg'; // Update this with your upload logic

    $stmt = $conn->prepare("INSERT into products SET product_name = ?, description = ?, price = ?, product_code = ?, image_url = ?");
    $stmt->bind_param("sssss", $name, $description, $price, $code, $image);
    $stmt->execute();
    echo "Product Added successfully!";
}

// Fetch all products
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Manage Products</title>
</head>
<body>
    <h1>Add New Product</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Product Name" required>
        <input type="text" name="description" placeholder="Description" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <input type="text" name="code" placeholder="Product Code" required>
        <button type="submit">Add Product</button>
    </form>

    <h2>Manage Existing Products</h2>
    <table>
        <tr>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Product Code</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['product_code']; ?></td>
            <td>
                <a href="?edit=<?php echo $row['product_id']; ?>">Edit</a> |
                <a href="?delete=<?php echo $row['product_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php if (isset($_GET['edit'])):
        $id = $_GET['edit'];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
    ?>
    <h2>Edit Product</h2>
    <form method="POST">
        <input type="hidden" name="edit_id" value="<?php echo $product['product_id']; ?>">
        <input type="text" name="name" value="<?php echo $product['product_name']; ?>" required>
        <input type="text" name="description" value="<?php echo $product['description']; ?>" required>
        <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
        <input type="text" name="code" value="<?php echo $product['product_code']; ?>" required>
        <button type="submit">Update Product</button>
    </form>
    <?php endif; ?>

    <form action="statistics.php" method="post">
                <button type="submit" class="start">Statistiken</button>
    </form>

</body>
</html>
