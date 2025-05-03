<?php
require_once 'config/db.php';
require_once 'src/models/User.php';

session_start();

class AuthController {
    /**
     * Regisztrációs folyamat
     */
    public static function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Adatok begyűjtése és tisztítása
            $name = htmlspecialchars(trim($_POST["name"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $password = trim($_POST["password"]);
            $confirmPassword = trim($_POST["confirm_password"]);

            // Alapellenőrzés
            if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
                $_SESSION['error'] = "Minden mező kitöltése kötelező!";
                header("Location: register.php");
                exit;
            }

            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "A jelszavak nem egyeznek!";
                header("Location: register.php");
                exit;
            }

            if (User::getUserByEmail($email)) {
                $_SESSION['error'] = "Ez az email cím már foglalt!";
                header("Location: register.php");
                exit;
            }

            // Jelszó hashelése és mentés az adatbázisba
            if (User::register($name, $email, $password)) {
                $_SESSION["success"] = "Sikeres regisztráció!";
                header("Location: login.php");
                exit;
            } else {
                $_SESSION['error'] = "Hiba történt a regisztráció során!";
                header("Location: register.php");
                exit;
            }
        }
    }

    /**
     * Bejelentkezési folyamat
     */
    public static function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST["email"]);
            $password = trim($_POST["password"]);

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = "Email és jelszó megadása kötelező!";
                header("Location: login.php");
                exit;
            }

            if (User::login($email, $password)) {
                $_SESSION["success"] = "Sikeres bejelentkezés!";
                header("Location: index.php");
                exit;
            } else {
                $_SESSION["error"] = "Hibás email vagy jelszó!";
                header("Location: login.php");
                exit;
            }
        }
    }

    /**
     * Kilépés
     */
    public static function logout() {
        session_unset(); // Munkamenet törlése
        session_destroy(); // Session teljes megsemmisítése
        header("Location: index.php");
        exit;
    }

    /**
     * Ellenőrzi, hogy a felhasználó be van-e jelentkezve
     */
    public static function isLoggedIn() {
        return isset($_SESSION['user']);
    }

    /**
     * Visszaadja a bejelentkezett felhasználó adatait
     */
    public static function getLoggedInUser() {
        return self::isLoggedIn() ? $_SESSION['user'] : null;
    }
}

// Az aktuális művelet meghívása URL paraméter alapján
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == "register") {
        AuthController::register();
    } elseif ($action == "login") {
        AuthController::login();
    } elseif ($action == "logout") {
        AuthController::logout();
    }
}
?>