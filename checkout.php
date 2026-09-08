<?php

include "config/database.php";

if (!isset($_SESSION["user_id"])) {

    header("Location: login.php");

    exit;

}

$user_id = $_SESSION["user_id"];


/* Calculate total */

$stmt = $conn->prepare(

"SELECT SUM(products.price * cart.quantity)
 AS total

 FROM cart

 JOIN products
 ON cart.product_id = products.id

 WHERE cart.user_id=?"

);

$stmt->bind_param("i", $user_id);

$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();

$total = $row["total"] ?? 0;


if ($_SERVER["REQUEST_METHOD"] == "POST"
    && $total > 0) {

    $stmt = $conn->prepare(

        "INSERT INTO orders
        (user_id,total_amount,status)
        VALUES (?,?,'Pending')"

    );

    $stmt->bind_param(
        "id",
        $user_id,
        $total
    );

    $stmt->execute();


    $stmt = $conn->prepare(
        "DELETE FROM cart WHERE user_id=?"
    );

    $stmt->bind_param(
        "i",
        $user_id
    );

    $stmt->execute();

    $success = true;

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Checkout - NovaShop</title>

<link rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="form-container">

<h1>NovaShop Checkout</h1>

<?php if(isset($success)): ?>

<h2>🎉 Order Placed Successfully!</h2>

<p>
Thank you for shopping with NovaShop.
</p>

<a href="index.php">
Continue Shopping
</a>

<?php else: ?>

<h2>Order Total</h2>

<h1>
₹<?php echo $total; ?>
</h1>

<form method="POST">

<input
type="text"
placeholder="Delivery Address"
required
>

<input
type="text"
placeholder="Phone Number"
required
>

<button type="submit">
Place Order
</button>

</form>

<?php endif; ?>

</div>

</body>

</html>