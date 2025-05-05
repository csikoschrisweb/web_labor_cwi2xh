<?php
// src/controllers/MessageController.php

require_once __DIR__ . '/../../config/db.php'; // Betöltjük az adatbázis kapcsolatot

class MessageController {

    // Üzenet mentése
    public static function sendMessage($name, $email, $message) {
        global $pdo;

        if (!$pdo) {
            die("Hiba: Nincs adatbázis kapcsolat (MessageController::sendMessage)!");
        }

        try {
            // Felkészített utasítás létrehozása
            $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            // Hibakezelés: ha a végrehajtás sikertelen, írjuk ki a hibát
            if (!$stmt->execute([$name, $email, $message])) {
                $errorInfo = $stmt->errorInfo();
                die('Adatbázis hiba (mentés): ' . $errorInfo[2]);
            }

            return true;

        } catch (PDOException $e) {
            die("Kivétel történt a mentés során: " . $e->getMessage());
        }
    }

    // Minden üzenet lekérése
    public static function getAllMessages() {
        global $pdo;

        if (!$pdo) {
            die("Hiba: Nincs adatbázis kapcsolat (MessageController::getAllMessages)!");
        }

        try {
            // Minden üzenet lekérése legújabb elöl
            $sql = "SELECT * FROM messages ORDER BY sent_at DESC";
            $stmt = $pdo->query($sql);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            die("Kivétel történt a lekérés során: " . $e->getMessage());
        }
    }
}
