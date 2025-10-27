<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="img/x-icon" href="img/minilogo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<img src="img/Gemeentelogo.png" alt="Logo" class="logoimg">
<div class="main">
    <h1 class="head1">Register</h1>
    <form action="">
        <input type="text" placeholder="First name" name="Fname" id="fname" required>
        <input type="text" placeholder="Last name" name="Lname" id="lname" required>
        <input type="text" placeholder="Adress" name="adress" id="adress" required>
        <input type="email" placeholder="Email" id="email" name="email" required>
        <input type="password" placeholder="Password" id="password" name="password" required>
        <button type="submit" class="wrap">Register</button>
    </form>
    <p class="reglink">Already got a account?
        <a href="Login.php">
            Login.
        </a>
    </p>
</div>
</body>
</html>
