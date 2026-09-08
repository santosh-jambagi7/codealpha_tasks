<?php

include "config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = password_hash(
        $_POST["password"],
        PASSWORD_DEFAULT
    );

    $stmt = $conn->prepare(
        "INSERT INTO users
        (name,email,password)
        VALUES (?,?,?)"
    );

    $stmt->bind_param(
        "sss",
        $name,
        $email,
        $password
    );

    if ($stmt->execute()) {

        header("Location: login.php");
        exit;

    } else {

        $message = "Email already exists.";

    }

}

?>

<!DOCTYPE html>

<html>

<head>

<title>Register - NovaShop</title>

<link rel="stylesheet"
href="css/style.css">

</head>

<body>

<div class="form-container">

<h1>✦ NovaShop</h1>

<h2>Create Account</h2>

<p class="error">
<?php echo $message; ?>
</p>

<form method="POST">

<input
type="text"
name="name"
placeholder="Full Name"
required
>

<input
type="email"
name="email"
placeholder="Email"
required
>

<input
type="password"
name="password"
placeholder="Password"
required
>

<button type="submit">
Register
</button>

</form>

<p>
Already have an account?
<a href="login.php">Login</a>
</p>

</div>

</body>

</html>