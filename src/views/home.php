<?php require_once 'templates/header.php'; ?>

<h1 class="fade-in">🌸 Üdvözöllek az Utazási Irodában! 🌸</h1>
<p class="fade-in">Fedezd fel Japán csodáit és tervezz egy felejthetetlen utazást!</p>

<!-- Parallax háttér Fuji-hegy -->
<div class="parallax-bg"></div>
<div class="japan-pattern"></div>

<h2>🎥 Bemutatkozó videók</h2>
<div class="video-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/XDZY7sHbRzA" title="Utazási Iroda Bemutatkozó" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

<div class="video-container">
    <video width="560" height="315" controls>
        <source src="public/videos/bemutato.mp4" type="video/mp4">
        A böngésződ nem támogatja a videólejátszást.
    </video>
</div>

<h2>📍 Google Térkép – Irodánk helye</h2>
<div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2749.373431032857!2d19.677971076805577!3d46.89847337125868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4742f0de1ab703ef%3A0x6f5e3d7804e62dd1!2sKecskem%C3%A9t%2C%20Rept%C3%A9ri%20%C3%BAt%204%2C%206000!5e0!3m2!1shu!2shu!4v1715086742000!5m2!1shu!2shu" 
    width="600" 
    height="400" 
    allowfullscreen="" 
    loading="lazy"
    style="border-radius:10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
    </iframe>
</div>

<h2>🖼️ Japán Képgaléria</h2>
<div class="gallery">
    <img src="public/images/gallery/kyoto_temple.jpg" alt="Kiotói Szentély">
    <img src="public/images/gallery/tokyo_skyline.jpg" alt="Tokió Éjszakai Látképe">
    <img src="public/images/gallery/torii_gate.jpg" alt="Japán Torii Kapu">
</div>

<?php require_once 'templates/footer.php'; ?>