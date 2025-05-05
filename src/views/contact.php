<h2>Kapcsolat</h2>

<?php
if (isset($_SESSION['error'])) {
    echo "<p style='color:red'>{$_SESSION['error']}</p>";
    unset($_SESSION['error']);
}
?>

<form id="contactForm" action="index.php?page=contact&action=submit_message" method="post">
    <label for="name">Név:</label><br>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="message">Üzenet:</label><br>
    <textarea id="message" name="message" rows="5" required></textarea><br><br>

    <button type="submit">Küldés</button>
</form>

<script>
document.getElementById("contactForm").addEventListener("submit", function(e) {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !message) {
        alert("Minden mezőt ki kell tölteni!");
        e.preventDefault();
    } else if (!/\S+@\S+\.\S+/.test(email)) {
        alert("Érvénytelen email cím!");
        e.preventDefault();
    }
});
</script>
