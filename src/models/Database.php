<?php
require_once 'config/config.php';

class Database {
    private static $conn;

    /**
     * Adatbázis kapcsolat létrehozása
     */
    public static function connect() {
        if (!isset(self::$conn)) {
            try {
                self::$conn = new PDO(
                    "sqlsrv:Server=" . DB_HOST . ";Database=" . DB_NAME, 
                    DB_USER, 
                    DB_PASS,
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (Exception $e) {
                error_log("Adatbázis kapcsolat hiba: " . $e->getMessage());
                die("Nem sikerült csatlakozni az adatbázishoz.");
            }
        }
        return self::$conn;
    }

    /**
     * Lekérdezés futtatása és eredmények visszaadása
     */
    public static function fetchAll($sql, $params = []) {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Egyetlen rekord lekérdezése
     */
    public static function fetchOne($sql, $params = []) {
        $stmt = self::connect()->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Adat beszúrása vagy módosítása
     */
    public static function executeQuery($sql, $params = []) {
        $stmt = self::connect()->prepare($sql);
        return $stmt->execute($params);
    }
}
?>