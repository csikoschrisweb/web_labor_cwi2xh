<?php require_once 'templates/header.php'; ?>
<h1>Kapcsolat</h1>

<form action="src/controllers/MessageController.php?action=send" method="post">
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Üzenet:</label>
    <textarea name="message" required></textarea>
    
    <button type="submit">Küldés</button>
</form>

<?php require_once 'templates/footer.php'; ?>
