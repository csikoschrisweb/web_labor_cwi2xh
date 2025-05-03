<?php require_once 'templates/header.php'; ?>
<h1>Képgaléria</h1>

<form action="src/controllers/ImageUploadController.php?action=upload" method="post" enctype="multipart/form-data">
    <label>Kép feltöltése:</label>
    <input type="file" name="image" required>
    <button type="submit">Feltöltés</button>
</form>

<h2>Feltöltött képek</h2>
<?php
$images = ImageUploadController::getImages();
foreach ($images as $img) {
    echo "<img src='public/images/{$img['file_name']}' alt='Kép'>";
}
?>

<?php require_once 'templates/footer.php'; ?>
