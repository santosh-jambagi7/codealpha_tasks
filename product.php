<?php

include "config/database.php";

$category = $_GET['category'] ?? '';

if ($category != '') {

    $stmt = $conn->prepare(
        "SELECT * FROM products WHERE category = ?"
    );

    $stmt->bind_param("s", $category);

    $stmt->execute();

    $result = $stmt->get_result();

} else {

    $result = $conn->query(
        "SELECT * FROM products"
    );

}

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Products - NovaShop</title>

<link rel="stylesheet"
href="css/style.css">

</head>

<body>

<header>

<div class="logo">
✦ NovaShop
</div>

<div class="actions">

<a href="index.php">Home</a>

<a href="cart.php">🛒 Cart</a>

</div>

</header>

<section class="section">

<h1>
<?php
echo $category
? ucfirst($category)
: "All Products";
?>
</h1>

<div class="products">

<?php while($product = $result->fetch_assoc()): ?>

<div class="product">

<div class="product-image">

<?php echo $product['icon']; ?>

</div>

<div class="product-info">

<h3>
<?php echo htmlspecialchars($product['name']); ?>
</h3>

<p>
<?php echo htmlspecialchars($product['description']); ?>
</p>

<div class="price">
₹<?php echo $product['price']; ?>
</div>

<?php if(isset($_SESSION['user_id'])): ?>

<a
class="add-cart"
href="cart.php?add=<?php echo $product['id']; ?>"
>
Add to Cart
</a>

<?php else: ?>

<a class="add-cart"
href="login.php">
Login to Buy
</a>

<?php endif; ?>

</div>

</div>

<?php endwhile; ?>

</div>

</section>

</body>

</html>