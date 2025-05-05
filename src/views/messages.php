<?php
require_once __DIR__ . '/../controllers/MessageController.php';
$messages = MessageController::getAllMessages();
?>

<h2>Üzenetek</h2>
<?php foreach ($messages as $msg): ?>
    <div>
        <strong><?= htmlspecialchars($msg['name']) ?></strong> (<?= htmlspecialchars($msg['email']) ?>) <br>
        <?= nl2br(htmlspecialchars($msg['message'])) ?>
    </div>
    <hr>
    
<?php endforeach; ?>
