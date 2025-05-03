<?php
session_start();

/**
 * Munkamenet indítása biztonságos beállításokkal
 */
function startSecureSession() {
    session_set_cookie_params([
        'lifetime' => 86400, // 1 nap
        'httponly' => true,
        'secure' => true
    ]);
    session_start();
}

/**
 * Bejelentkezett felhasználó ellenőrzése
 */
function isAuthenticated() {
    return isset($_SESSION['user']);
}

/**
 * Munkamenet törlése (kilépéskor)
 */
function destroySession() {
    session_unset();
    session_destroy();
}
?>
