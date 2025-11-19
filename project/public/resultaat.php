<?php
// public/resultaat.php
// points to project root
define('BASE_PATH', dirname(__DIR__)); 
require_once __DIR__ . '/../app/controllers/VoteController.php';

$controller = new VoteController();

$verkiezingen = $controller->getElections();

$selected_verkiezing_id = isset($_GET['verkiezing_id']) && $_GET['verkiezing_id'] !== '' ? intval($_GET['verkiezing_id']) : null;
$kandidaten_results = [];
$selected_verkiezing_name = '';

if ($selected_verkiezing_id !== null) {
    $kandidaten_results = $controller->getResults($selected_verkiezing_id);

    // find name
    foreach ($verkiezingen as $v) {
        if ($v['id'] == $selected_verkiezing_id) {
            $selected_verkiezing_name = $v['naam'];
            break;
        }
    }
}

require_once __DIR__ . '/../app/views/resultaat.view.php';
