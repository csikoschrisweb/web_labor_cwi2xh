<?php
// src/models/Image.php
require_once __DIR__ . '/../../config/db.php'; // Betöltjük a db.php-t

class Image {

    // Képek lekérése
    public static function fetchImages() {
        global $pdo; // Globálisan hivatkozunk a PDO kapcsolatot

        // Ellenőrizzük, hogy a PDO kapcsolat elérhető-e
        if ($pdo === null) {
            die("Az adatbázis kapcsolat nem jött létre!");
        }

        try {
            // SQL lekérdezés
            $sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(); // Lekérdezés végrehajtása
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Eredmény visszaadása
        } catch (PDOException $e) {
            die("Hiba a lekérdezés végrehajtásakor: " . $e->getMessage());
        }
    }

    // Kép mentése az adatbázisba
    public static function saveImage($userId, $fileName) {
        global $pdo; // Globálisan hivatkozunk a PDO kapcsolatot

        // Ellenőrizzük, hogy a PDO kapcsolat elérhető-e
        if ($pdo === null) {
            die("Az adatbázis kapcsolat nem jött létre!");
        }

        try {
            // SQL lekérdezés a kép mentésére
            $sql = "INSERT INTO images (user_id, file_name) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$userId, $fileName]); // Futtatjuk a lekérdezést
            return $stmt->rowCount() > 0; // Ha sikerült, akkor true-t adunk vissza
        } catch (PDOException $e) {
            die("Hiba a kép mentése során: " . $e->getMessage());
        }
    }
}
