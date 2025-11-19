<?php
// app/models/Candidate.php

require_once __DIR__ . '/../core/Database.php';

class Candidate {
    private PDO $db;

    public function __construct(Database $database) {
        $this->db = $database->getConnection();
    }

    public function add(string $naam, string $partij): bool {
        $sql = "INSERT INTO kandidaten (naam, partij) VALUES (:naam, :partij)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['naam' => $naam, 'partij' => $partij]);
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT id, naam, partij FROM kandidaten");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByIds(array $ids): array {
        if (empty($ids)) return [];
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->db->prepare("SELECT id, naam FROM kandidaten WHERE id IN ($placeholders)");
        $stmt->execute($ids);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
