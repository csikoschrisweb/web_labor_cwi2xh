<?php
// Alkalmazás beállítások
define("APP_NAME", "Japán Utazási Iroda");
define("BASE_URL", "http://localhost/utazasi_iroda");

// Adatbázis kapcsolat konfigurációja
define("DB_HOST", "localhost");
define("DB_NAME", "utazasi_iroda");
define("DB_USER", "root");
define("DB_PASS", "");

// Engedélyezett menüpontok
$menu = [
    'home' => 'Főoldal',
    'utazasok' => 'Utazások',
    'galeria' => 'Galéria',
    'kapcsolat' => 'Kapcsolat',
    'messages' => 'Üzenetek',
    'profile' => 'Profil',
    'login' => 'Belépés',
    'register' => 'Regisztráció'
];

// Engedélyezett fájlok az oldalak betöltésére
$allowedPages = array_keys($menu);
?>