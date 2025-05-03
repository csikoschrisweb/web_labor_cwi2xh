document.addEventListener("DOMContentLoaded", function() {
    console.log("Az oldal dinamikus effektjei betöltődtek!");

    // Parallax görgetési effekt
    window.addEventListener("scroll", () => {
        document.querySelector(".parallax-bg").style.transform = `translateY(${window.scrollY * 0.4}px)`;
    });

    // Hover-effekt gombokhoz és képekhez
    document.querySelectorAll("button, .gallery img").forEach(el => {
        el.addEventListener("mouseover", () => {
            el.style.transition = "all 0.3s";
            el.style.transform = "scale(1.05)";
        });
        el.addEventListener("mouseleave", () => {
            el.style.transform = "scale(1)";
        });
    });

    // Szöveg beúszás animáció
    document.querySelectorAll(".fade-in").forEach(el => {
        el.style.opacity = "0";
        el.style.transform = "translateY(20px)";
        setTimeout(() => {
            el.style.transition = "opacity 1s, transform 1s";
            el.style.opacity = "1";
            el.style.transform = "translateY(0)";
        }, 300);
    });

    // Modális ablak megjelenítése
    document.querySelectorAll(".modal-trigger").forEach(trigger => {
        trigger.addEventListener("click", () => {
            document.querySelector(".modal").classList.add("visible");
        });
    });

    document.querySelector(".modal .close").addEventListener("click", () => {
        document.querySelector(".modal").classList.remove("visible");
    });

    // Képgaléria nagyítás funkció
    document.querySelectorAll(".gallery img").forEach(img => {
        img.addEventListener("click", () => {
            const modalImg = document.querySelector(".modal img");
            modalImg.src = img.src;
            document.querySelector(".modal").classList.add("visible");
        });
    });
});
