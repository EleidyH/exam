<?php
// app/views/kandidaat.view.php
require_once BASE_PATH . '/app/views/templates/header.php';?>
<h1>Kandidaat Toevoegen</h1>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<div class="main">
    <form action="/kandidaat.php" method="POST">
        <label for="naam">Naam:</label><br>
        <input type="text" id="naam" name="naam" required><br><br>

        <label for="partij">Partij Naam:</label><br>
        <input type="text" id="partij" name="partij" required><br><br>

        <button type="submit">Toevoegen</button>
    </form>
</div>

<?php require_once BASE_PATH . 'app/view/templates/footer.php'; ?>
