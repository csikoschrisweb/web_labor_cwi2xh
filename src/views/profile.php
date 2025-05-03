<?php require_once 'templates/header.php'; ?>

<?php
$userData = ProfileController::getProfileData();
?>

<h1>Felhasználói profil</h1>
<p><strong>Név:</strong> <?php echo $userData['name']; ?></p>
<p><strong>Email:</strong> <?php echo $userData['email']; ?></p>

<h2>Profil frissítése</h2>
<form action="src/controllers/ProfileController.php?action=update" method="post">
    <label>Név:</label>
    <input type="text" name="name" value="<?php echo $userData['name']; ?>" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo $userData['email']; ?>" required>
    
    <button type="submit">Profil frissítése</button>
</form>

<h2>Jelszó módosítása</h2>
<form action="src/controllers/ProfileController.php?action=changePassword" method="post">
    <label>Új jelszó:</label>
    <input type="password" name="new_password" required>
    
    <button type="submit">Jelszó módosítása</button>
</form>

<?php require_once 'templates/footer.php'; ?>
