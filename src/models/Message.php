<?php
// src/models/Message.php

require_once __DIR__ . '/../../config/db.php'; // Betöltjük az adatbázis kapcsolatot

class Message {

    // Új üzenet létrehozása
    public static function create($name, $email, $message) {
        global $pdo;
        if (!$pdo) {
            die("Hiba: Nincs adatbázis kapcsolat (Message::create)!");
        }

        $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name, $email, $message]);
    }

    // Az összes üzenet lekérése
    public static function getAll() {
        global $pdo;
        if (!$pdo) {
            die("Hiba: Nincs adatbázis kapcsolat (Message::getAll)!");
        }

        $sql = "SELECT * FROM messages ORDER BY sent_at DESC";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
