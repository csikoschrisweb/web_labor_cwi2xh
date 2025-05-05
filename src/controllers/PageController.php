<?php

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../includes/functions.php';

class PageController {
    /**
     * Oldal betöltése URL alapján
     *
     * @param string $page The name of the page to load (e.g., 'home', 'contact')
     */
    public static function loadPage($page) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        global $menu;

        $templatesDir = __DIR__ . '/../../templates';
        $viewsDir = __DIR__ . '/../views';

        // === KEZELJÜK A REGISZTRÁCIÓS POST-OT ===
        if ($page === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../controllers/AuthController.php';

            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $email = trim($_POST['email']);
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (AuthController::register($firstName, $lastName, $email, $username, $password)) {
                $_SESSION['success'] = "Sikeres regisztráció! Most már bejelentkezhetsz.";
                header("Location: index.php?page=login");
                exit;
            } else {
                $_SESSION['error'] = "A regisztráció nem sikerült! Lehet, hogy a felhasználónév már foglalt.";
                // Visszatérünk a regisztrációs oldalhoz (folytatjuk a view betöltését)
            }
        }

        // --- Include Header ---
        $headerFile = $templatesDir . '/header.php';
        if (file_exists($headerFile)) {
            include $headerFile;
        } else {
            error_log("Header file not found: " . $headerFile);
            echo "<p>Error: Header template is missing.</p>";
        }

        // --- Include View ---
        $viewFile = $viewsDir . "/$page.php";
        if (file_exists($viewFile)) {
            include $viewFile;
        } else {
            http_response_code(404);
            error_log("View file not found: " . $viewFile . " for page: " . $page);
            $errorViewFile = $viewsDir . '/404.php'; 
            if (file_exists($errorViewFile)) {
                include $errorViewFile;
            } else {
                echo "<h2>404 - Page Not Found</h2>";
                echo "<p>The requested page could not be found.</p>";
            }
        }

        // --- Include Footer ---
        $footerFile = $templatesDir . '/footer.php';
        if (file_exists($footerFile)) {
            include $footerFile;
        } else {
            error_log("Footer file not found: " . $footerFile);
            echo "<p>Error: Footer template is missing.</p>";
        }
    }
}
