<?php

require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../models/Image.php';

class ImageUploadController {
    public static function uploadImage() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();
            if (!isset($_SESSION['user'])) {
                $_SESSION['error'] = "Csak bejelentkezett felhasználók tölthetnek fel képeket!";
                header("Location: index.php?page=gallery");
                exit;
            }

            if (!isset($_FILES["image"]) || $_FILES["image"]["error"] !== UPLOAD_ERR_OK) {
                $_SESSION['error'] = "Hiba történt a fájl feltöltésekor!";
                header("Location: index.php?page=gallery");
                exit;
            }

            $userId = $_SESSION['user']['id'];
            $imageName = basename($_FILES["image"]["name"]);
            $imageTmpName = $_FILES["image"]["tmp_name"];
            $imageSize = $_FILES["image"]["size"];
            $imageType = mime_content_type($imageTmpName);
            $uploadDir = __DIR__ . '/../../public/images/';

            // Méret és típus ellenőrzés
            if ($imageSize > 5 * 1024 * 1024) {
                $_SESSION['error'] = "A fájl túl nagy (max. 5MB)!";
                header("Location: index.php?page=gallery");
                exit;
            }

            $allowedTypes = ["image/jpeg", "image/png", "image/gif"];
            if (!in_array($imageType, $allowedTypes)) {
                $_SESSION['error'] = "Csak JPEG, PNG és GIF fájlok engedélyezettek!";
                header("Location: index.php?page=gallery");
                exit;
            }

            // Mappa létezik-e
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $newFileName = uniqid() . "_" . $imageName;
            $targetFile = $uploadDir . $newFileName;

            if (move_uploaded_file($imageTmpName, $targetFile)) {
                if (Image::saveImage($userId, $newFileName)) {
                    $_SESSION['success'] = "A kép sikeresen feltöltve!";
                } else {
                    $_SESSION['error'] = "Adatbázis hiba történt!";
                }
            } else {
                $_SESSION['error'] = "Nem sikerült feltölteni a fájlt!";
            }

            header("Location: index.php?page=gallery");
            exit;
        }
    }

    public static function getImages() {
        return Image::fetchImages();
    }
}

// Meghívás URL alapján
if (isset($_GET['action']) && $_GET['action'] == "upload_image") {
    ImageUploadController::uploadImage();
}
