<?php

require 'db.php';

$query = "SELECT id, naam FROM kandidaten";
$stmt = $pdo->query($query);
$kandidaten = $stmt->fetchAll(PDO::FETCH_ASSOC);


$verkiezingen_query = "SELECT id, naam FROM verkiezing";
$verkiezingen_stmt = $pdo->query($verkiezingen_query);
$verkiezingen = $verkiezingen_stmt->fetchAll(PDO::FETCH_ASSOC);


$message = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    if (isset($_POST['add_verkiezing'])) {
        $naam = $_POST['naam']; 
        $datum = $_POST['datum'];
        $beschrijving = $_POST['beschrijving'];
        
        if (!empty($naam) && !empty($datum) && !empty($beschrijving)) {
            try {
              
                $stmt = $pdo->prepare("INSERT INTO verkiezing (naam, datum, beschrijving) VALUES (:naam, :datum, :beschrijving)");
                $stmt->execute(['naam' => $naam, 'datum' => $datum, 'beschrijving' => $beschrijving]);

                $message = "Nieuwe verkiezing toegevoegd!";
            } catch (PDOException $e) {
                $message = "Fout bij toevoegen: " . $e->getMessage();
            }
        } else {
            $message = "Vul alle velden in voor de verkiezing!";
        }
    }

    
    if (isset($_POST['add_kandidaten'])) {
        $verkiezing_id = $_POST['verkiezing_id']; 
        $kandidaten_ids = $_POST['kandidaten'];  

        if (!empty($verkiezing_id) && !empty($kandidaten_ids)) {
            try {
                
                foreach ($kandidaten_ids as $kandidaat_id) {
                    $stmt = $pdo->prepare("INSERT INTO verkiezing_kandidaten (verkiezing_id, kandidaat_id) VALUES (:verkiezing_id, :kandidaat_id)");
                    $stmt->execute(['verkiezing_id' => $verkiezing_id, 'kandidaat_id' => $kandidaat_id]);
                }

                $message = "Kandidaten toegevoegd aan de verkiezing!";
            } catch (PDOException $e) {
                $message = "Fout bij toevoegen: " . $e->getMessage();
            }
        } else {
            $message = "Vul alle velden in!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Kandidaten Toe aan Verkiezing</title>
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
    <h1>Verkiezing Beheren</h1>
    
    <?php if (!empty($message)): ?>
        <p style="color: green;"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <div class="main">
    <h2>Nieuwe Verkiezing Toevoegen</h2>
    <form action="verkiezing.php" method="POST">
        <label for="naam">Verkiezing Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br>

        <label for="datum">Datum:</label><br>
        <input type="date" id="datum" name="datum" required><br>

        <label for="beschrijving">Beschrijving:</label><br>
        <textarea id="beschrijving" name="beschrijving" rows="2" cols="50" required></textarea><br>

        <button type="submit" name="add_verkiezing">Toevoegen</button>
    </form>

    <hr><hr>
 
    <h2>Kandidaten Toevoegen aan Bestaande Verkiezing</h2>
    <form action="verkiezing.php" method="POST">
        <label for="verkiezing_id">Verkiezing Naam:</label><br>
        <select name="verkiezing_id" id="verkiezing_id" required>
            <?php foreach ($verkiezingen as $verkiezing): ?>
                <option value="<?php echo $verkiezing['id']; ?>"><?php echo htmlspecialchars($verkiezing['naam']); ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="kandidaten">Kandidaten:</label><br>
        <select name="kandidaten[]" id="kandidaten" multiple required>
            <?php foreach ($kandidaten as $kandidaat): ?>
                <option value="<?php echo $kandidaat['id']; ?>"><?php echo htmlspecialchars($kandidaat['naam']); ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit" name="add_kandidaten">Toevoegen</button>
    </form>
    </div>
</body>
</html>
