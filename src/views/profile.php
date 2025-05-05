<?php
require_once 'templates/header.php';
require_once 'controllers/ProfileController.php';

$userData = ProfileController::getProfileData(); // Lekérjük a felhasználó adatokat
?>

<h1>Felhasználói profil</h1>
<p><strong>Név:</strong> <?php echo htmlspecialchars($userData['name']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>

<h2>Profil frissítése</h2>
<form action="profile.php?action=update" method="post">
    <label>Név:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
    
    <button type="submit">Profil frissítése</button>
</form>

<h2>Jelszó módosítása</h2>
<form action="profile.php?action=changePassword" method="post">
    <label>Új jelszó:</label>
    <input type="password" name="new_password" required>
    
    <button type="submit">Jelszó módosítása</button>
</form>

<?php require_once 'templates/footer.php'; ?>
