<?php
// public/stem.php
// points to project root
define('BASE_PATH', dirname(__DIR__)); 
require_once __DIR__ . '/../app/controllers/VoteController.php';

$controller = new VoteController();
$message = $controller->submitVoteFromRequest();

$verkiezingen = $controller->getElections();

$kandidaten = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['verkiezing_id'])) {
    $verkiezing_id = intval($_POST['verkiezing_id']);
    $kandidaten = $controller->getCandidatesForElection($verkiezing_id);
} elseif (!empty($_GET['verkiezing_id'])) {
    // handle GET if you want to preselect via query param
    $verkiezing_id = intval($_GET['verkiezing_id']);
    $kandidaten = $controller->getCandidatesForElection($verkiezing_id);
}

require_once __DIR__ . '/../app/views/stem.view.php';
