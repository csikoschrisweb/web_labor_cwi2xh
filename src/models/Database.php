<?php
require_once __DIR__ . 
'/../../config/config.php
';

class Database {
    private static $conn;

    /**
     * Adatbázis kapcsolat létrehozása (MySQL)
     */
    public static function connect() {
        if (!isset(self::$conn)) {
            try {
                
                self::$conn = new PDO(
                    "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", 
                    DB_USER, 
                    DB_PASS,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
                        PDO::ATTR_EMULATE_PREPARES => false, 
                    ]
                );
            } catch (PDOException $e) { 
                error_log("Database connection error: " . $e->getMessage());
                
                die("Could not connect to the database. Please check the configuration or contact support.");
            }
        }
        return self::$conn;
    }

    /**
     * Lekérdezés futtatása és eredmények visszaadása
     */
    public static function fetchAll($sql, $params = []) {
        try {
            $stmt = self::connect()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(); 
        } catch (PDOException $e) {
            error_log("Database fetchAll error: " . $e->getMessage() . " SQL: " . $sql);
            return []; 
        }
    }

    /**
     * Egyetlen rekord lekérdezése
     */
    public static function fetchOne($sql, $params = []) {
        try {
            $stmt = self::connect()->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(); 
        } catch (PDOException $e) {
            error_log("Database fetchOne error: " . $e->getMessage() . " SQL: " . $sql);
            return null; 
        }
    }

    /**
     * Adat beszúrása vagy módosítása (INSERT, UPDATE, DELETE)
     */
    public static function executeQuery($sql, $params = []) {
        try {
            $stmt = self::connect()->prepare($sql);
            return $stmt->execute($params); 
        } catch (PDOException $e) {
            error_log("Database executeQuery error: " . $e->getMessage() . " SQL: " . $sql);
            return false; 
        }
    }

    /**
     * Utolsó beszúrt ID lekérése
     */
    public static function lastInsertId() {
        return self::$conn ? self::$conn->lastInsertId() : null;
    }
}
?>
