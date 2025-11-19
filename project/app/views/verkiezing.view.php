<?php
// app/views/verkiezing.view.php
require_once BASE_PATH . '/app/views/templates/header.php';?>
<h1>Verkiezing Beheren</h1>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<div class="main">
    <h2>Nieuwe Verkiezing Toevoegen</h2>
    <form action="/verkiezing.php" method="POST">
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
    <form action="/verkiezing.php" method="POST">
        <label for="verkiezing_id">Verkiezing Naam:</label><br>
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

<?php require_once BASE_PATH . 'app/view/templates/footer.php'; ?>
