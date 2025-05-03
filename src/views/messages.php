<?php require_once 'templates/header.php'; ?>
<h1>Beérkezett üzenetek</h1>

<?php
$messages = MessageController::getMessages();
foreach ($messages as $msg) {
    echo "<p><strong>{$msg['name']}</strong> ({$msg['email']}): {$msg['message']} - {$msg['sent_at']}</p>";
}
?>

<?php require_once 'templates/footer.php'; ?>
