<?php
// A bejelentkezett felhasználó adatainak ellenőrzése
$loggedInUser = null;
if (isset($_SESSION['user'])) {
    $loggedInUser = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(APP_NAME); ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>

<header>
    <h1>🌸 <?php echo htmlspecialchars(APP_NAME); ?> 🌸</h1>

    <nav>
        <?php if (isset($menu) && is_array($menu)): ?>
            <?php foreach ($menu as $key => $name): ?>
                <a href="<?php echo BASE_URL; ?>/index.php?page=<?php echo urlencode($key); ?>"><?php echo htmlspecialchars($name); ?></a>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($loggedInUser): ?>
            <!-- Profil és kilépés linkek -->
            <a href="<?php echo BASE_URL; ?>/index.php?page=profile">👤 Profil</a>
            <a href="<?php echo BASE_URL; ?>/src/views/logout.php">🚪 Kilépés</a>
            <p class="user-info">Bejelentkezett: <?php echo htmlspecialchars($loggedInUser['username']); ?></p>
        <?php else: ?>
        <?php endif; ?>
    </nav>
</header>

<main>
    <!-- Itt jeleníthetjük meg a sikeres vagy hibás üzeneteket -->
    <?php 
    if (function_exists('displaySuccess')) {
        displaySuccess();
    }
    if (function_exists('displayError')) {
        displayError();
    }
    ?>
