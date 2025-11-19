<?php
// app/views/verkiezing.view.php
require_once BASE_PATH . '/app/views/templates/header.php';?>
<h1>Partij Beheren</h1>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<div class="main">
    <h2>Nieuwe Partij Toevoegen</h2>
    <form action="/verkiezing.php" method="POST">
        <label for="naam">Partij Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br>

        <label for="datum">Datum:</label><br>
        <input type="date" id="datum" name="datum" required><br>

        <label for="beschrijving">Beschrijving:</label><br>
        <textarea id="beschrijving" name="beschrijving" rows="2" cols="50" required></textarea><br>

        <button type="submit" name="add_verkiezing">Toevoegen</button>
    </form>

    <hr><hr>

    <h2>Kandidaten Toevoegen aan Bestaande Partij</h2>
    <form action="/verkiezing.php" method="POST">
        <label for="verkiezing_id">Partij Naam:</label><br>
        <select name="verkiezing_id" id="verkiezing_id" required>
            <?php foreach ($verkiezingen as $v): ?>
                <option value="<?= $v['id'] ?>"><?= htmlspecialchars($v['naam']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="kandidaten">Kandidaten:</label><br>
        <select name="kandidaten[]" id="kandidaten" multiple required>
            <?php foreach ($kandidaten as $k): ?>
                <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['naam']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit" name="add_kandidaten">Toevoegen</button>
    </form>
</div>

<?php require_once BASE_PATH . '\app\views\templates\footer.php'; ?>