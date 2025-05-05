<?php

// Be kell tölteni a db.php fájlt, hogy elérjük a $pdo-t
require_once __DIR__ . '/../../config/db.php'; // A db.php fájl helyének megfelelő elérési úttal

// Ha a $pdo nincs beállítva, akkor a globális változót kell használni
global $pdo; // Ezt a sor biztosítja, hogy a globális $pdo-t használjuk

if (!$pdo) {
    die("Hiba: Nincs adatbázis kapcsolat (User::findByUsername)!");
}

class User {

    // Keresés felhasználónév alapján
    public static function findByUsername($username) {
        global $pdo;
        // Biztosítjuk, hogy a "username" oszlop létezik az adatbázisban.
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Új felhasználó létrehozása
    public static function create($firstName, $lastName, $email, $username, $password) {
        global $pdo;
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (first_name, last_name, email, username, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$firstName, $lastName, $email, $username, $passwordHash]);
    }

    // Felhasználó adatainak lekérése ID alapján
    public static function getUserById($id) {
        global $pdo;
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Profil frissítése
    public static function updateProfile($userId, $name, $email) {
        global $pdo;
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$name, $email, $userId]);
    }

    // Jelszó frissítése
    public static function changePassword($userId, $newPassword) {
        global $pdo;
        $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$passwordHash, $userId]);
    }
}
?>
