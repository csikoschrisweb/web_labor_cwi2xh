<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../controllers/AuthController.php';

$error = ''; // Hibák tárolása

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (AuthController::login($username, $password)) {
        header('Location: index.php'); // Belépés után átirányítás
        exit;
    } else {
        $error = 'Hibás felhasználónév vagy jelszó.';
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belépés</title>
</head>
<body>
    <h2>Belépés</h2>

    <?php if ($error): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <!-- Belépési űrlap -->
    <form method="POST">
        <label>Felhasználónév: <input type="text" name="username" required></label><br>
        <label>Jelszó: <input type="password" name="password" required></label><br>
        <button type="submit">Belépés</button>
    </form>

    <p>Még nincs fiókod? <a href="register.php">Regisztrálj itt!</a></p>
</body>
</html>
