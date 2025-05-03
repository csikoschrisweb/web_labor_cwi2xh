<?php
require_once 'src/models/User.php';

/**
 * Bejelentkezett felhasználó adatai
 */
function getAuthenticatedUser() {
    return isAuthenticated() ? $_SESSION['user'] : null;
}

/**
 * Beléptetés és session mentés
 */
function authenticateUser($email, $password) {
    if (User::login($email, $password)) {
        header("Location: profile.php");
        exit;
    } else {
        $_SESSION['error'] = "Hibás email vagy jelszó!";
        header("Location: login.php");
        exit;
    }
}

/**
 * Kilépési folyamat
 */
function logoutUser() {
    destroySession();
    header("Location: index.php");
    exit;
}
?>
