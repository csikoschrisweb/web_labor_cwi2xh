<?php
require_once 'config/db.php';

class Message {
    /**
     * Új üzenet mentése az adatbázisba
     */
    public static function saveMessage($name, $email, $message) {
        $sql = "INSERT INTO messages (name, email, message, sent_at) VALUES (?, ?, ?, NOW())";
        return executeQuery($sql, [$name, $email, $message]);
    }

    /**
     * Üzenetek lekérése az adatbázisból
     */
    public static function fetchMessages() {
        $sql = "SELECT * FROM messages ORDER BY sent_at DESC";
        return fetchAll($sql);
    }
}
?>