<?php
// app/controllers/VoteController.php

require_once __DIR__ . '/../models/Vote.php';
require_once __DIR__ . '/../models/Election.php';
require_once __DIR__ . '/../models/Candidate.php';
require_once __DIR__ . '/../core/Database.php';

class VoteController {
    private Vote $voteModel;
    private Election $electionModel;
    private Candidate $candidateModel;

    public function __construct() {
        $db = new Database();
        $this->voteModel = new Vote($db);
        $this->electionModel = new Election($db);
        $this->candidateModel = new Candidate($db);
    }

    public function submitVoteFromRequest(): string {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $verkiezing_id = intval($_POST['verkiezing_id'] ?? 0);
            $kandidaat_id = intval($_POST['kandidaat_id'] ?? 0);

            if ($verkiezing_id === 0 || $kandidaat_id === 0) {
                return "Kies een verkiezing en een kandidaat!";
            }

            try {
                $this->voteModel->add($verkiezing_id, $kandidaat_id);
                return "Je hebt gestemd!";
            } catch (PDOException $e) {
                return "Fout bij stemmen: " . $e->getMessage();
            }
        }
        return '';
    }

    public function getElections(): array {
        return $this->electionModel->getAll();
    }

    public function getCandidatesForElection(int $verkiezing_id): array {
        return $this->electionModel->getCandidates($verkiezing_id);
    }

    public function getResults(int $verkiezing_id): array {
        return $this->voteModel->getResults($verkiezing_id);
    }
}
