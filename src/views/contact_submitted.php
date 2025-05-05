<h2>Üzenet elküldve</h2>

<?php
if (isset($_SESSION['submitted'])) {
    $data = $_SESSION['submitted'];
    echo "<p><strong>Név:</strong> {$data['name']}</p>";
    echo "<p><strong>Email:</strong> {$data['email']}</p>";
    echo "<p><strong>Üzenet:</strong><br>{$data['message']}</p>";
    unset($_SESSION['submitted']);
} else {
    echo "<p>Nincs elküldött üzenet.</p>";
}
?>
