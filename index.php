<?php
// Session indítása a fájl elején
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/src/controllers/PageController.php';
require_once __DIR__ . '/src/controllers/MessageController.php'; // <-- Ez kell a kapcsolat kezeléséhez

// Az URL-ből lekérjük a kért oldalt, alapértelmezetten 'home'
$page = $_GET['page'] ?? 'home';

// Validáljuk, hogy a kért oldal szerepel-e a menüben (config.php-ban van meghatározva)
if (!isset($menu[$page])) {
    $page = 'home'; // Ha nem valid oldal, akkor alapértelmezetten 'home' oldal
}

// A kapcsolat űrlap elküldése
if ($page === 'contact' && isset($_GET['action']) && $_GET['action'] === 'submit_message') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Az űrlap adatainak összegyűjtése
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Validálás
        if ($name && $email && $message) {
            // Üzenet mentése a MessageController-ben
            $success = MessageController::sendMessage($name, $email, $message);
            
            if ($success) {
                // Ha sikeres a mentés
                $_SESSION['success'] = "Üzenet sikeresen elküldve!";
            } else {
                // Ha hiba történt
                $_SESSION['error'] = "Hiba történt az üzenet mentésekor.";
            }
        } else {
            // Ha valamelyik mező üres
            $_SESSION['error'] = "Minden mezőt ki kell tölteni!";
        }

        // Visszairányítjuk a kapcsolat oldalra, hogy ne történjen újra az űrlap küldése
        header("Location: index.php?page=contact");
        exit;
    }
}

// Az oldal betöltése a PageController segítségével
PageController::loadPage($page);

// Ha a galéria oldalról van szó és fájlt akarunk feltölteni
if ($page === 'gallery' && isset($_GET['action']) && $_GET['action'] === 'upload_image') {
    ImageUploadController::uploadImage();
}
?>
