<?php
require_once 'config/db.php';
require_once 'src/models/Message.php';

session_start();

class MessageController {
    /**
     * Üzenet mentése az adatbázisba
     */
    public static function sendMessage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = isset($_SESSION['user']) ? $_SESSION['user']['name'] : "Vendég";
            $email = isset($_SESSION['user']) ? $_SESSION['user']['email'] : trim($_POST["email"]);
            $message = htmlspecialchars(trim($_POST["message"]));

            if (empty($message)) {
                $_SESSION['error'] = "Az üzenet mező nem lehet üres!";
                header("Location: kapcsolat.php");
                exit;
            }

            if (Message::saveMessage($name, $email, $message)) {
                $_SESSION["success"] = "Üzenet sikeresen elküldve!";
                header("Location: messages.php");
                exit;
            } else {
                $_SESSION['error'] = "Hiba történt az üzenet mentésekor!";
                header("Location: kapcsolat.php");
                exit;
            }
        }
    }

    /**
     * Üzenetek lekérése az adatbázisból
     */
    public static function getMessages() {
        return Message::fetchMessages();
    }
}

// Az aktuális művelet meghívása URL paraméter alapján
if (isset($_GET['action']) && $_GET['action'] == "send") {
    MessageController::sendMessage();
}
?>