<?php
// header.php - shared header for all views

// Optional: start session if needed
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define BASE_URL for CSS/JS links if not already defined
if (!defined('BASE_URL')) {
    define('BASE_URL', '/exam/project/public');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Verkiezingen' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL ?>/stem.php">Stem</a></li>
            <li><a href="<?= BASE_URL ?>/resultaat.php">Resultaten</a></li>
            <li><a href="<?= BASE_URL ?>/kandidaat.php">Kandidaten Toevoegen</a></li>
            <li><a href="<?= BASE_URL ?>/verkiezing.php">Verkiezing Toevoegen</a></li>
        </ul>
    </nav>

    <div class="main">
