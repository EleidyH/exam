<?php
// app/controllers/CandidateController.php

require_once __DIR__ . '/../models/Candidate.php';
require_once __DIR__ . '/../core/Database.php';

class CandidateController {
    private Candidate $candidateModel;

    public function __construct() {
        $db = new Database();
        $this->candidateModel = new Candidate($db);
    }

    public function addFromRequest(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $naam = trim($_POST['naam'] ?? '');
            $partij = trim($_POST['partij'] ?? '');

            if ($naam === '' || $partij === '') {
                return "Vul alle velden in!";
            }

            try {
                $this->candidateModel->add($naam, $partij);
                return "Kandidaat toegevoegd!";
            } catch (PDOException $e) {
                return "Fout bij toevoegen: " . $e->getMessage();
            }
        }
        return '';
    }

    public function index(): array {
        return $this->candidateModel->getAll();
    }
}
