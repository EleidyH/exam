<?php

require 'db.php';


$message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naam = $_POST['naam'];
    $partij = $_POST['partij'];

    if (!empty($naam) && !empty($partij)) {
        try {
            
            $stmt = $pdo->prepare("INSERT INTO kandidaten (naam, partij) VALUES (:naam, :partij)");
            $stmt->execute(['naam' => $naam, 'partij' => $partij]);
            $message = "Kandidaat toegevoegd!";
        } catch (PDOException $e) {
            $message = "Fout bij toevoegen: " . $e->getMessage();
        }
    } else {
        $message = "Vul alle velden in!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kandidaat Toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="stem.php">Stem</a></li>
            <li><a href="resultaat.php">Resultaten</a></li>
            <li><a href="kandidaat.php">Kandidaten Toevoegen</a></li>
            <li><a href="verkiezing.php">Verkiezing Toevoegen</a></li>
        </ul>
    </nav>
    <h1>Kandidaat Toevoegen</h1>

   
    <?php if (!empty($message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

<div class="main">
    <form action="kandidaat.php" method="POST">
        <label for="naam">Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="partij">Partij Naam:</label><br>
        <input type="text" id="partij" name="partij" required><br><br>

        <button type="submit">Toevoegen</button>
    </form>
    </div>
</body>
</html>
