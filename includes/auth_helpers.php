<?php
// Correct path using __DIR__
require_once __DIR__ . 
'/../src/models/User.php


'; // Include User model for isLoggedIn check if kept

/**
 * Bejelentkezett felhasználó adatai
 * Note: Consider using User::isLoggedIn() and fetching user data directly where needed
 * instead of this helper.
 * Session must be started before calling this.
 */
function getAuthenticatedUser() {
    // Check using the User model's method if session is active
    if (session_status() == PHP_SESSION_ACTIVE && User::isLoggedIn()) {
        return $_SESSION[
'user

'];
    }
    return null;
}

// Removed authenticateUser() - Logic is now in AuthController::login() and User::login()
// Removed logoutUser() - Logic is now in AuthController::logout() and User::logout()

?>
