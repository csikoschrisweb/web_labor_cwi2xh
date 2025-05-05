<?php
ob_start(); 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';


$action = $_GET['action'] ?? null;

switch ($action) {
    case 'register':
        registerUser($pdo);
        break;

    case 'login':
        loginUser($pdo);
        break;

    case 'logout':
        logoutUser();
        break;

    default:
        die("Invalid action.");
}

function registerUser($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        $password_confirm = trim($_POST["password_confirm"]);

        
        if (empty($username) || empty($password) || empty($password_confirm)) {
            $_SESSION["error"] = "Minden mező kitöltése kötelező!";
            header("Location: register.php"); // Regisztrációs oldalra való visszairányítás
            exit;
        }

        
        if ($password !== $password_confirm) {
            $_SESSION["error"] = "A jelszavak nem egyeznek!";
            header("Location: register.php"); // Regisztrációs oldalra való visszairányítás
            exit;
        }

        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(["username" => $username]);
        if ($stmt->fetch()) {
            $_SESSION["error"] = "A felhasználónév már foglalt!";
            header("Location: register.php"); // Regisztrációs oldalra való visszairányítás
            exit;
        }

        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(["username" => $username, "password" => $hashedPassword]);

        $_SESSION["success"] = "Sikeres regisztráció! Most már bejelentkezhetsz.";
        header("Location: login.php"); // Átirányítás a login oldalra
        exit;
    }
}

function loginUser($pdo) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);

        // Check if username exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(["username" => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user["password"])) {
            $_SESSION["error"] = "Hibás felhasználónév vagy jelszó!";
            header("Location: login.php"); // Átirányítás a login oldalra
            exit;
        }

        $_SESSION["user"] = $user;
        header("Location: profile.php"); // Átirányítás a felhasználó profiljára
        exit;
    }
}

function logoutUser() {
    session_destroy();
    header("Location: login.php"); // Átirányítás a login oldalra
    exit;
}
?>
