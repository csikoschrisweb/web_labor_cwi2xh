<h2>Képgaléria</h2>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>{$_SESSION['error']}</p>";
    unset($_SESSION['error']);
}

if (isset($_SESSION['success'])) {
    echo "<p style='color:green'>{$_SESSION['success']}</p>";
    unset($_SESSION['success']);
}
?>

<?php if (isset($_SESSION['user'])): ?>
    <form action="index.php?page=gallery&action=upload_image" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit">Feltöltés</button>
    </form>
<?php else: ?>
    <p>Képfeltöltéshez be kell jelentkeznie.</p>
<?php endif; ?>

<h3>Feltöltött képek</h3>
<div style="display: flex; flex-wrap: wrap;">
    <?php
    require_once __DIR__ . '/../controllers/ImageUploadController.php';
    $images = ImageUploadController::getImages();
    foreach ($images as $img) {
        echo "<div style='margin:10px;'><img src='public/images/{$img['file_name']}' alt='Kép' width='200'></div>";
    }
    ?>
</div>
