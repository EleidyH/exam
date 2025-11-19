<?php
// app/models/Election.php

require_once __DIR__ . '/../core/Database.php';

class Election {
    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function add(string $naam, string $datum, string $beschrijving): bool {
        $sql = "INSERT INTO verkiezing (naam, datum, beschrijving) VALUES (:naam, :datum, :beschrijving)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'naam' => $naam,
            'datum' => $datum,
            'beschrijving' => $beschrijving
        ]);
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT id, naam, datum, beschrijving FROM verkiezing");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function linkCandidates(int $verkiezing_id, array $candidate_ids): bool {
        $sql = "INSERT INTO verkiezing_kandidaten (verkiezing_id, kandidaat_id) VALUES (:verkiezing_id, :kandidaat_id)";
        $stmt = $this->db->prepare($sql);
        foreach ($candidate_ids as $id) {
            $stmt->execute(['verkiezing_id' => $verkiezing_id, 'kandidaat_id' => $id]);
        }
        return true;
    }

    public function getCandidates(int $verkiezing_id): array {
        $sql = "SELECT k.id, k.naam 
                FROM kandidaten k
                JOIN verkiezing_kandidaten vk ON k.id = vk.kandidaat_id
                WHERE vk.verkiezing_id = :verkiezing_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['verkiezing_id' => $verkiezing_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
