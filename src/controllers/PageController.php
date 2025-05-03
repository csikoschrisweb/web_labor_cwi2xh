<?php
require_once 'config/config.php';

class PageController {
    /**
     * Oldal betöltése URL alapján
     */
    public static function loadPage() {
        // Az URL paraméterből kinyerjük az oldal nevét
        $page = $_GET['page'] ?? 'home';

        // Ellenőrizzük, hogy az oldal az engedélyezett listában szerepel-e
        global $menu;
        if (!array_key_exists($page, $menu)) {
            $page = 'home'; // Ha nem létezik, visszairányítjuk a főoldalra
        }

        // Fejléc betöltése
        include "templates/header.php";

        // Oldal tartalom betöltése
        include "src/views/$page.php";

        // Lábjegyzet betöltése
        include "templates/footer.php";
    }
}

// Vezérlő meghívása
PageController::loadPage();
?>