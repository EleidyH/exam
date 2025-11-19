<?php
// app/models/Vote.php

require_once __DIR__ . '/../core/Database.php';

class Vote {
    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function add(int $verkiezing_id, int $kandidaat_id): bool {
        $sql = "INSERT INTO stemmen (verkiezing_id, kandidaat_id) VALUES (:verkiezing_id, :kandidaat_id)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['verkiezing_id' => $verkiezing_id, 'kandidaat_id' => $kandidaat_id]);
    }

    public function getResults(int $verkiezing_id): array {
        $sql = "SELECT k.id, k.naam, COUNT(s.id) AS votes
                FROM kandidaten k
                LEFT JOIN stemmen s ON k.id = s.kandidaat_id AND s.verkiezing_id = :verkiezing_id
                GROUP BY k.id, k.naam
                ORDER BY votes DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['verkiezing_id' => $verkiezing_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
