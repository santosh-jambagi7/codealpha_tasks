<?php

include "config/database.php";

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;

}

$user_id = $_SESSION["user_id"];


/* Add product */

if (isset($_GET["add"])) {

    $product_id = intval($_GET["add"]);

    $stmt = $conn->prepare(
        "SELECT id FROM cart
         WHERE user_id=? AND product_id=?"
    );

    $stmt->bind_param(
        "ii",
        $user_id,
        $product_id
    );

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {

        $stmt = $conn->prepare(
            "UPDATE cart
             SET quantity = quantity + 1
             WHERE user_id=? AND product_id=?"
        );

        $stmt->bind_param(
            "ii",
            $user_id,
            $product_id
        );

        $stmt->execute();

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO cart
             (user_id,product_id,quantity)
             VALUES (?,?,1)"
        );

        $stmt->bind_param(
            "ii",
            $user_id,
            $product_id
        );

        $stmt->execute();

    }

    header("Location: cart.php");

    exit;

}


/* Remove product */

if (isset($_GET["remove"])) {

    $id = intval($_GET["remove"]);

    $stmt = $conn->prepare(
        "DELETE FROM cart
         WHERE id=? AND user_id=?"
    );

    $stmt->bind_param(
        "ii",
        $id,
        $user_id
    );

    $stmt->execute();

    header("Location: cart.php");

    exit;

}


/* Cart products */

$stmt = $conn->prepare(

"SELECT cart.id,
        products.name,
        products.price,
        products.icon,
        cart.quantity

 FROM cart

 JOIN products
 ON cart.product_id = products.id

 WHERE cart.user_id=?"

);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

$total = 0;

?>

<!DOCTYPE html>

<html>

<head>

<title>Cart - NovaShop</title>

<link rel="stylesheet"
href="css/style.css">

</head>

<body>

<header>

<div class="logo">
✦ NovaShop
</div>

<a href="index.php">
Continue Shopping
</a>

</header>


<section class="cart-page">

<h1>Your Shopping Cart 🛒</h1>

<?php while($item = $result->fetch_assoc()): ?>

<?php

$subtotal =
$item["price"] *
$item["quantity"];

$total += $subtotal;

?>

<div class="cart-item">

<span>
<?php echo $item["icon"]; ?>
<?php echo htmlspecialchars($item["name"]); ?>
</span>

<span>
₹<?php echo $item["price"]; ?>
</span>

<span>
Quantity:
<?php echo $item["quantity"]; ?>
</span>

<a href="cart.php?remove=<?php echo $item["id"]; ?>">
Remove
</a>

</div>

<?php endwhile; ?>


<h2>
Total: ₹<?php echo $total; ?>
</h2>

<?php if($total > 0): ?>

<a
class="checkout-btn"
href="checkout.php"
>
Proceed to Checkout
</a>

<?php else: ?>

<p>Your cart is empty.</p>

<?php endif; ?>

</section>

</body>

</html>