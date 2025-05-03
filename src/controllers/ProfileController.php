<?php
require_once 'config/db.php';
require_once 'src/models/User.php';

session_start();

class ProfileController {
    /**
     * Felhasználói profil megjelenítése
     */
    public static function getProfileData() {
        if (!isset($_SESSION['user'])) {
            header("Location: login.php");
            exit;
        }

        return User::getUserById($_SESSION['user']['id']);
    }

    /**
     * Profil frissítése
     */
    public static function updateProfile() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user'])) {
            $userId = $_SESSION['user']['id'];
            $name = trim($_POST["name"]);
            $email = trim($_POST["email"]);

            if (empty($name) || empty($email)) {
                $_SESSION['error'] = "Minden mező kitöltése kötelező!";
                header("Location: profile.php");
                exit;
            }

            if (User::updateProfile($userId, $name, $email)) {
                $_SESSION['success'] = "Profil sikeresen frissítve!";
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['email'] = $email;
                header("Location: profile.php");
                exit;
            } else {
                $_SESSION['error'] = "Hiba történt a profil frissítésekor!";
                header("Location: profile.php");
                exit;
            }
        }
    }
}

// Az aktuális művelet meghívása URL paraméter alapján
if (isset($_GET['action']) && $_GET['action'] == "update") {
    ProfileController::updateProfile();
}
?>