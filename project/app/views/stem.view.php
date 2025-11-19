<?php
// app/views/stem.view.php
require_once BASE_PATH . '/app/views/templates/header.php';?>
<h1>Stem op Verkiezing</h1>

<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<div class="main">
    <form action="/stem.php" method="POST">
        <label for="verkiezing_id">Kies een Verkiezing:</label><br>
        <select name="verkiezing_id" id="verkiezing_id" onchange="this.form.submit()">
            <option value="">Selecteer Verkiezing</option>
            <?php foreach ($verkiezingen as $v): ?>
                <option value="<?= $v['id'] ?>" <?= (isset($_POST['verkiezing_id']) && $_POST['verkiezing_id'] == $v['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($v['naam']) ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <?php if (!empty($kandidaten)): ?>
            <label for="kandidaat_id">Kies een Kandidaat:</label><br>
            <select name="kandidaat_id" id="kandidaat_id" required>
                <option value="">Selecteer Kandidaat</option>
                <?php foreach ($kandidaten as $k): ?>
                    <option value="<?= $k['id'] ?>"><?= htmlspecialchars($k['naam']) ?></option>
                <?php endforeach; ?>
            </select><br>

            <button type="submit">Stem</button>
        <?php endif; ?>
    </form>
</div>

<?php require_once BASE_PATH . 'app/view/templates/footer.php'; ?>
