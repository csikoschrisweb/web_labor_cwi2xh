<?php
/**
 * Biztonságos bemenet tisztítása
 */
function sanitizeInput($data) {
    return htmlspecialchars(trim($data));
}

/**
 * Hibák megjelenítése
 */
function displayError() {
    if (isset($_SESSION['error'])) {
        echo "<p class='error'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
}

/**
 * Sikerek megjelenítése
 */
function displaySuccess() {
    if (isset($_SESSION['success'])) {
        echo "<p class='success'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
}
?>
