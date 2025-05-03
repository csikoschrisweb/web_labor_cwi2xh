<?php
require_once 'config/db.php';
require_once 'src/models/Image.php';

session_start();

class ImageUploadController {
    /**
     * Kép feltöltése és mentése
     */
    public static function uploadImage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Ellenőrizzük, hogy be van-e jelentkezve a felhasználó
            if (!isset($_SESSION['user'])) {
                $_SESSION['error'] = "Csak bejelentkezett felhasználók tölthetnek fel képeket!";
                header("Location: galeria.php");
                exit;
            }

            $userId = $_SESSION['user']['id'];
            $imageName = $_FILES["image"]["name"];
            $imageTmpName = $_FILES["image"]["tmp_name"];
            $imageSize = $_FILES["image"]["size"];
            $imageType = $_FILES["image"]["type"];
            $uploadDir = "public/images/";

            // Fájlméret ellenőrzés (max. 5MB)
            if ($imageSize > 5 * 1024 * 1024) {
                $_SESSION['error'] = "A fájl túl nagy (max. 5MB)!";
                header("Location: galeria.php");
                exit;
            }

            // Csak bizonyos fájlformátumokat engedélyezünk
            $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            if (!in_array($imageType, $allowedTypes)) {
                $_SESSION['error'] = "Csak JPEG, PNG és GIF fájlok engedélyezettek!";
                header("Location: galeria.php");
                exit;
            }

            // Egyedi fájlnév létrehozása
            $newFileName = uniqid() . "_" . basename($imageName);
            $targetFile = $uploadDir . $newFileName;

            // Fájl mentése
            if (move_uploaded_file($imageTmpName, $targetFile)) {
                if (Image::saveImage($userId, $newFileName)) {
                    $_SESSION['success'] = "A kép sikeresen feltöltve!";
                    header("Location: galeria.php");
                    exit;
                } else {
                    $_SESSION['error'] = "Hiba történt a kép mentésekor!";
                    header("Location: galeria.php");
                    exit;
                }
            } else {
                $_SESSION['error'] = "Nem sikerült feltölteni a fájlt!";
                header("Location: galeria.php");
                exit;
            }
        }
    }

    /**
     * Képek lekérdezése az adatbázisból
     */
    public static function getImages() {
        return Image::fetchImages();
    }
}

// Az aktuális művelet meghívása URL paraméter alapján
if (isset($_GET['action']) && $_GET['action'] == "upload") {
    ImageUploadController::uploadImage();
}