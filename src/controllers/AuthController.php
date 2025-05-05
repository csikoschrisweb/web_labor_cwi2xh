<?php

require_once __DIR__ . '/../models/User.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class AuthController {

    /**
     * Felhasználó belépése
     */
    public static function login($username, $password) {
        // Ellenőrizzük, hogy létezik-e a felhasználó
        $user = User::findByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'first_name' => $user['first_name'],
                'last_name' => $user['last_name'],
                'username' => $user['username']
            ];
            return true;
        }
        return false;
    }

    /**
     * Felhasználó regisztrációja
     */
    public static function register($firstName, $lastName, $email, $username, $password) {
        // Ellenőrizzük, hogy létezik-e már a felhasználónév
        if (User::findByUsername($username)) {
            return false; // A felhasználónév már foglalt
        }
        return User::create($firstName, $lastName, $email, $username, $password);
    }

    /**
     * Kilépés
     */
    public static function logout() {
        session_destroy(); // Bezárjuk a session-t
        header("Location: " . BASE_URL . "/index.php"); // Visszairányítjuk a főoldalra
        exit;
    }
}
