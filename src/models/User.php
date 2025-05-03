<?php
require_once 'config/db.php';

class User {
    /**
     * Felhasználói adat lekérése ID alapján
     */
    public static function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = ?";
        return fetchOne($sql, [$id]);
    }

    /**
     * Felhasználó keresése email alapján
     */
    public static function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        return fetchOne($sql, [$email]);
    }

    /**
     * Felhasználó regisztrációja
     */
    public static function register($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        return executeQuery($sql, [$name, $email, $hashedPassword]);
    }

    /**
     * Bejelentkezési folyamat
     */
    public static function login($email, $password) {
        $user = self::getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            return true;
        }
        return false;
    }

    /**
     * Ellenőrzi, hogy a felhasználó be van-e jelentkezve
     */
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    /**
     * Felhasználói profil frissítése
     */
    public static function updateProfile($id, $name, $email) {
        $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
        return executeQuery($sql, [$name, $email, $id]);
    }

    /**
     * Jelszó módosítása
     */
    public static function changePassword($id, $newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        return executeQuery($sql, [$hashedPassword, $id]);
    }

    /**
     * Kilépés a munkamenetből
     */
    public static function logout() {
        session_destroy();
    }
}
?>