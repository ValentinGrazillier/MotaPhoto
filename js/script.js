// Gestion du menu burger et animation pour passage au design en croix

document.addEventListener("DOMContentLoaded", function () {
    const boutonBurger = document.querySelector(".menu-burger");
    const nav = document.querySelector("nav");
    const lignes = document.querySelectorAll(".ligne");
    const navigationBurger = document.querySelector(".navigation-burger");

    boutonBurger.addEventListener("click", function () {
        // Gestion du menu burger et de la modale pour éviter la superposition des deux
        if (navigationBurger.style.display === "none" && modale.style.display === "block") {
            modale.style.display = "none";
        }
        if (nav.classList.value.includes("active")) {
            nav.classList.remove("active");
            lignes[0].classList.remove("croixgauche");
            lignes[1].classList.remove("croixdroite");
            lignes[2].style.display = "block";
            navigationBurger.style.display = "none";
        }
        else {
        nav.classList.add("active");
        lignes[0].classList.add("croixgauche");
        lignes[1].classList.add("croixdroite");
        lignes[2].style.display = "none";
        navigationBurger.style.display = "block";
        }
    });

/////////////////////////////////////////////////////////////////////////

// Gestion de la modale de contact au clic

    const boutonContactHeader = document.querySelector(".menu-item-41 a");
    const modale = document.querySelector(".emplacement-modale");
    const boutonFermeture = document.querySelector(".fermeture");
    const contenuModale = document.getElementById("modale-contact");

    boutonContactHeader.addEventListener("click", function() {
        // Gestion de la fermeture de la modale - En cliquant à nouveau sur Contact
        if (modale.style.display === "block") {
            modale.style.display = "none";
        } 
        else {
            modale.style.display = "block";
        }
    });

    // Gestion de la fermeture de la modale - Au clic sur la croix
    boutonFermeture.addEventListener("click", function() {
        modale.style.display = "none";
    });

    // Gestion de la fermeture de la modale - Au clic en dehors de la modale
    window.addEventListener('click', (event) => {
        if (event.target === contenuModale) {
            modale.style.display = "none";
        }
    });

/////////////////////////////////////////////////////////////////////////

// Clic sur Contact depuis le menu burger

    const boutonContactBurger = document.querySelector(".navigation-burger .menu-item-41 a");

    boutonContactBurger.addEventListener("click", function () {
        nav.classList.remove("active");
        lignes[0].classList.remove("croixgauche");
        lignes[1].classList.remove("croixdroite");
        lignes[2].style.display = "block";
        navigationBurger.style.display = "none";
        modale.style.display = "block";
    });
});