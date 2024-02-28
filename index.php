<?php
$db = new mysqli('your_db_host', 'your_db_user', 'your_db_password', 'your_db_name');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

function getProducts() {
    global $db;
    $result = $db->query("SELECT * FROM products");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getRecommendedProducts($userId) {
    // Simulated recommendation logic (replace this with a real recommendation engine)
    $recommendedIds = [1, 3]; // Example: Recommending products with IDs 1 and 3
    $recommendedProducts = [];
    foreach ($recommendedIds as $productId) {
        $result = $db->query("SELECT * FROM products WHERE id = $productId");
        $recommendedProducts[] = $result->fetch_assoc();
    }
    return $recommendedProducts;
}

$products = getProducts();
$userId = isset($_GET['user_id']) ? $_GET['user_id'] : 0;
$recommendedProducts = getRecommendedProducts($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce Platform</title>
</head>
<body>
    <h1>E-commerce Platform</h1>

    <h2>All Products</h2>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?= $product['name'] ?> - $<?= $product['price'] ?></li>
        <?php endforeach; ?>
    </ul>

    <h2>Recommended Products</h2>
    <ul>
        <?php foreach ($recommendedProducts as $product): ?>
            <li><?= $product['name'] ?> - $<?= $product['price'] ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
