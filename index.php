<?php
require_once 'config/config.php';
require_once 'src/controllers/PageController.php';
require_once 'templates/header.php';

// Az URL-ből kinyerjük az oldal nevét
$page = $_GET['page'] ?? 'home';

// Ellenőrizzük, hogy az oldal létezik-e a konfigurációban
if (!in_array($page, array_keys($menu))) {
    $page = 'home'; // Ha nem létezik, visszairányítjuk a főoldalra
}

// Oldal tartalom megjelenítése
PageController::loadPage($page);

require_once 'templates/footer.php';
?>