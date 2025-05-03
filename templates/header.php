<?php
session_start();
require_once 'config/config.php';
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>

<header>
    <h1>🌸 <?php echo APP_NAME; ?> 🌸</h1>

    <!-- Navigációs menü -->
    <nav>
        <?php foreach ($menu as $key => $name): ?>
            <a href="index.php?page=<?php echo $key; ?>"><?php echo $name; ?></a>
        <?php endforeach; ?>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="index.php?page=profile">👤 プロフィール</a>
            <a href="src/controllers/AuthController.php?action=logout">🚪 ログアウト</a>
            <p class="user-info">Bejelentkezett: <?php echo $_SESSION['user']['name']; ?> (<?php echo $_SESSION['user']['email']; ?>)</p>
        <?php else: ?>
            <a href="index.php?page=login">🔑 ログイン</a>
            <a href="index.php?page=register">📝 新規登録</a>
        <?php endif; ?>
    </nav>
</header>

<main>
