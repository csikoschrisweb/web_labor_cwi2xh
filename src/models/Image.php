<?php
require_once 'config/db.php';

class Image {
    /**
     * Kép mentése az adatbázisba
     */
    public static function saveImage($userId, $fileName) {
        $sql = "INSERT INTO images (user_id, file_name, uploaded_at) VALUES (?, ?, NOW())";
        return executeQuery($sql, [$userId, $fileName]);
    }

    /**
     * Képek lekérdezése az adatbázisból
     */
    public static function fetchImages() {
        $sql = "SELECT * FROM images ORDER BY uploaded_at DESC";
        return fetchAll($sql);
    }
}
?>