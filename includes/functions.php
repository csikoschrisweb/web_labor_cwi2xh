<?php
/**
 * Biztonságos bemenet tisztítása
 */
function sanitizeOutput($data) {
    
    return htmlspecialchars($data, ENT_QUOTES, 
'UTF-8
');
}

/**
 * Hibák megjelenítése
 */
function displayError() {
    if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION[
'error
'])) {
        // Sanitize the error message before echoing
        echo "<p class=
'error
'>" . sanitizeOutput($_SESSION[
'error
']) . "</p>";
        // Unset the message after displaying
        unset($_SESSION[
'error
']);
    }
}

/**
 * Sikerek megjelenítése
 * Ensures session is active and sanitizes output.
 */
function displaySuccess() {
    // Check if session is active before accessing $_SESSION
    if (session_status() == PHP_SESSION_ACTIVE && isset($_SESSION[
'success
'])) {
        // Sanitize the success message before echoing
        echo "<p class=
'success
'>" . sanitizeOutput($_SESSION[
'success
']) . "</p>";
        // Unset the message after displaying
        unset($_SESSION[
'success
']);
    }
}


?>
