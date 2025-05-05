<h2>Regisztráció</h2>

<!-- Hibaüzenet megjelenítése -->
<?php if (isset($_SESSION['error'])): ?>
    <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<!-- Sikeres regisztráció üzenet -->
<?php if (isset($_SESSION['success'])): ?>
    <p style="color: green;"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<!-- Regisztrációs űrlap -->
<form method="POST" action="index.php?page=register">
    <label for="firstName">Keresztnév:</label>
    <input type="text" name="firstName" id="firstName" required><br><br>

    <label for="lastName">Vezetéknév:</label>
    <input type="text" name="lastName" id="lastName" required><br><br>

    <label for="email">Email cím:</label>
    <input type="email" name="email" id="email" required><br><br>
    
    <label for="username">Felhasználónév:</label>
    <input type="text" name="username" id="username" required><br><br>

    <label for="password">Jelszó:</label>
    <input type="password" name="password" id="password" required><br><br>

    <input type="submit" value="Regisztráció">
</form>

<p>Már van fiókod? <a href="index.php?page=login">Jelentkezz be!</a></p>
