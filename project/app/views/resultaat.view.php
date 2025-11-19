<?php
// app/views/resultaat.view.php
require_once BASE_PATH . '/app/views/templates/header.php';?>
<h1>Stem Resultaten</h1>

<div class="main">
    <form action="/resultaat.php" method="GET">
        <label for="verkiezing_id">Kies een Verkiezing:</label><br>
        <select name="verkiezing_id" id="verkiezing_id" onchange="this.form.submit()">
            <option value="">Selecteer Verkiezing</option>
            <?php foreach ($verkiezingen as $v): ?>
                <option value="<?= $v['id'] ?>" <?= ($v['id'] == $selected_verkiezing_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($v['naam']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>
    </form>

    <?php if (!empty($kandidaten_results)): ?>
        <h2>Stem Resultaten voor Verkiezing: <?= htmlspecialchars($selected_verkiezing_name) ?></h2>
        <table>
            <tr>
                <th>Kandidaat</th>
                <th>Stemmen</th>
            </tr>
            <?php foreach ($kandidaten_results as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['naam']) ?></td>
                    <td><?= $row['votes'] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif ($selected_verkiezing_id !== null): ?>
        <p>Er zijn geen stemmen geregistreerd voor deze verkiezing.</p>
    <?php endif; ?>
</div>

<?php require_once BASE_PATH . 'app/view/templates/footer.php'; ?>
 