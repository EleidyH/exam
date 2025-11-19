<?php
// app/controllers/ElectionController.php

require_once __DIR__ . '/../models/Election.php';
require_once __DIR__ . '/../models/Candidate.php';
require_once __DIR__ . '/../core/Database.php';

class ElectionController {
    private Election $electionModel;
    private Candidate $candidateModel;

    public function __construct() {
        $db = new Database();
        $this->electionModel = new Election($db);
        $this->candidateModel = new Candidate($db);
    }

    public function addElectionFromRequest(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_verkiezing'])) {
            $naam = trim($_POST['naam'] ?? '');
            $datum = trim($_POST['datum'] ?? '');
            $beschrijving = trim($_POST['beschrijving'] ?? '');

            if ($naam === '' || $datum === '' || $beschrijving === '') {
                return "Vul alle velden in voor de verkiezing!";
            }

            try {
                $this->electionModel->add($naam, $datum, $beschrijving);
                return "Nieuwe verkiezing toegevoegd!";
            } catch (PDOException $e) {
                return "Fout bij toevoegen: " . $e->getMessage();
            }
        }
        return '';
    }

    public function addCandidatesFromRequest(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_kandidaten'])) {
            $verkiezing_id = intval($_POST['verkiezing_id'] ?? 0);
            $kandidaten_ids = $_POST['kandidaten'] ?? [];

            if ($verkiezing_id === 0 || empty($kandidaten_ids)) {
                return "Vul alle velden in!";
            }

            try {
                $this->electionModel->linkCandidates($verkiezing_id, $kandidaten_ids);
                return "Kandidaten toegevoegd aan de verkiezing!";
            } catch (PDOException $e) {
                return "Fout bij toevoegen: " . $e->getMessage();
            }
        }
        return '';
    }

    public function allElections(): array {
        return $this->electionModel->getAll();
    }

    public function allCandidates(): array {
        return $this->candidateModel->getAll();
    }
}
