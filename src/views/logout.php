<?php
// logout.php

// Hívjuk meg az AuthController-t a logout metódussal
require_once __DIR__ . '/../controllers/AuthController.php';

// Kilépés
AuthController::logout();
?>