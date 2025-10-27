<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="img/x-icon" href="img/minilogo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img src="img/Gemeentelogo.png" alt="Logo" class="logoimg">
<div class="main">
    <h1 class="head1">Login</h1>
    <form action="">
        <input type="email" placeholder="Email" id="email" name="email" required><br>
        <input type="password" placeholder="Password" id="password" name="password" required><br>
        <button type="submit" class="wrap">Login</button>
    </form>
    <p class="reglink">Not registered?
        <a href="Register.php">
            Create an account
        </a>
    </p>
</div>
</body>
</html>
