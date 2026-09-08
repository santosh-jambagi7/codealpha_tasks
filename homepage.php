<?php
include "config/database.php";

$result = $conn->query(
    "SELECT * FROM products ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>NovaShop - Online Shopping</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<header>

    <div class="logo">
        ✦ NovaShop
    </div>

    <div class="search">
        <input
            type="text"
            id="searchInput"
            placeholder="Search products..."
        >

        <button onclick="searchProducts()">
            🔍
        </button>
    </div>

    <div class="actions">

        <?php if(isset($_SESSION['user_id'])): ?>

            <span>
                👤
                <?php echo htmlspecialchars($_SESSION['user_name']); ?>
            </span>

            <a href="logout.php">Logout</a>

        <?php else: ?>

            <a href="login.php">Login</a>
            <a href="register.php">Register</a>

        <?php endif; ?>

        <a href="cart.php">🛒 Cart</a>

    </div>

</header>


<nav>

<a href="index.php">Home</a>

<a href="products.php?category=electronics">
Electronics
</a>

<a href="products.php?category=fashion">
Fashion
</a>

<a href="products.php?category=home">
Home & Living
</a>

<a href="products.php?category=beauty">
Beauty
</a>

<a href="products.php?category=sports">
Sports
</a>

</nav>


<section class="hero">

<div class="hero-content">

<p>WELCOME TO NOVASHOP</p>

<h1>
Discover Everything<br>
You <span>Love.</span>
</h1>

<p>
Shop quality products at amazing prices.
Fast delivery and secure shopping.
</p>

<a class="shop-btn" href="#products">
Shop Now →
</a>

</div>

<div class="hero-icon">
🛍️
</div>

</section>


<section class="features">

<div>
🚚
<strong>Free Delivery</strong>
<small>Orders over ₹999</small>
</div>

<div>
🔒
<strong>Secure Payment</strong>
<small>100% secure</small>
</div>

<div>
↩️
<strong>Easy Returns</strong>
<small>7 days return</small>
</div>

<div>
☎️
<strong>24/7 Support</strong>
<small>We're here to help</small>
</div>

</section>


<section class="section" id="products">

<h2>Popular Products</h2>

<div class="products" id="productContainer">

<?php while($product = $result->fetch_assoc()): ?>

<div class="product">

<div class="product-image">

<?php echo $product['icon']; ?>

</div>

<div class="product-info">

<h3>
<?php echo htmlspecialchars($product['name']); ?>
</h3>

<div class="rating">
★★★★★
</div>

<div class="price">

₹<?php echo $product['price']; ?>

<del>
₹<?php echo $product['old_price']; ?>
</del>

</div>

<?php if(isset($_SESSION['user_id'])): ?>

<a
class="add-cart"
href="cart.php?add=<?php echo $product['id']; ?>"
>
Add to Cart
</a>

<?php else: ?>

<a
class="add-cart"
href="login.php"
>
Login to Buy
</a>

<?php endif; ?>

</div>

</div>

<?php endwhile; ?>

</div>

</section>


<footer>

<div>

<h2>✦ NovaShop</h2>

<p>
Your one-stop destination for quality
products at amazing prices.
</p>

</div>

<div>

<h3>Quick Links</h3>

<a href="index.php">Home</a>
<a href="products.php">Products</a>
<a href="login.php">Login</a>
<a href="register.php">Register</a>

</div>

<div>

<h3>Customer Service</h3>

<p>Help Center</p>
<p>Shipping</p>
<p>Returns</p>
<p>Privacy Policy</p>

</div>

</footer>

<div class="copyright">

© 2026 NovaShop. All Rights Reserved.

</div>


<script src="js/script.js"></script>

</body>
</html>