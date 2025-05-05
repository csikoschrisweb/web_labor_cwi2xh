<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Alkalmazás beállítások
define("APP_NAME", "Japán Utazási Iroda");
define("BASE_URL", "http://cwi2xh.nhely.hu");

// Adatbázis kapcsolat konfigurációja
define("DB_HOST", "localhost");
define("DB_NAME", "web_labor_cwi2xh");
define("DB_USER", "web_labor_cwi2xh");
define("DB_PASS", "webbeadando2025");

$db_config = [
    'host' => 'localhost',
    'dbname' => 'web_labor_cwi2xh',
    'username' => 'web_labor_cwi2xh',  
    'password' => 'webbeadando2025',       
    'driver' => 'mysql'
];
// Engedélyezett menüpontok
$menu = [
    'home' => 'Főoldal',
    'utazasok' => 'Utazások',
    'gallery' => 'Galéria',
    'contact' => 'Kapcsolat',
    'messages' => 'Üzenetek',
    'login' => 'Belépés',
    'register' => 'Regisztráció'
];

// Engedélyezett fájlok az oldalak betöltésére
$allowedPages = array_keys($menu);
?>
