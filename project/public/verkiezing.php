<?php
// public/verkiezing.php
// points to project root
define('BASE_PATH', dirname(__DIR__)); 
require_once __DIR__ . '/../app/controllers/ElectionController.php';

$controller = new ElectionController();
$message = $controller->addElectionFromRequest();
if ($message === '') {
    $message = $controller->addCandidatesFromRequest();
}

$verkiezingen = $controller->allElections();
$kandidaten = $controller->allCandidates();

require_once __DIR__ . '/../app/views/verkiezing.view.php';
