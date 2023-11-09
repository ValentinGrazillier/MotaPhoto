document.addEventListener("DOMContentLoaded", function () {
    
    // Gestion du menu burger et animation pour passage au design en croix

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

/////////////////////////////////////////////////////////////////////////
    
// Clic sur Contact sur la page d'une photo et remplissage automatique de la référence en fonction de la photo

    // Si on se trouve sur la page single-photo.php seulement
    const urlActuelle = window.location.href;
    
    if (urlActuelle.match(/photographies/)) {
        const boutonContactPhoto = document.querySelector(".bouton-photo-unique");
        const modaleBis = document.querySelector(".emplacement-modale");
        const refARemplir = document.querySelector(".reference-formulaire input");
        const refADupliquer = document.getElementById("reference");

        boutonContactPhoto.addEventListener("click", function () {
            nav.classList.add("active");
            refARemplir.value = refADupliquer.textContent;
            modaleBis.style.display = "block";
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }

/////////////////////////////////////////////////////////////////////////

// Flèches de navigation sur single-photo.php

    // Si on se trouve sur la page single-photo.php seulement
    if (urlActuelle.match(/photographies/)) {
        const flechePrecedente = document.querySelector('.fleche-gauche');
        const flecheSuivante = document.querySelector('.fleche-droite');
        const zoneVignetteGauche = document.querySelector('.conteneur-vignette-precedent');
        const zoneVignetteDroite = document.querySelector('.conteneur-vignette-suivant');

        flechePrecedente.addEventListener('mouseenter', function() {
            zoneVignetteGauche.style.display = "flex";
        });

        flechePrecedente.addEventListener('mouseleave', function() {
            zoneVignetteGauche.style.display = "none";
        });

        flecheSuivante.addEventListener('mouseenter', function() {
            zoneVignetteDroite.style.display = "flex";
        });

        flecheSuivante.addEventListener('mouseleave', function() {
            zoneVignetteDroite.style.display = "none";
        });
    }

    overlay();
});

/////////////////////////////////////////////////////////////////////////

// Overlay des photos de photo-bloc.php

function overlay() {
    // Apparition de l'overlay au survol
    const autresPhotos = document.querySelectorAll('.autres-photos');

    autresPhotos.forEach(element => {
        const overlay = element.querySelector('.survol-photo');
        const oeil = element.querySelector('.oeil');
        const divLienPhoto = element.querySelector('.lien-photo');
        const lienPhoto = divLienPhoto.innerHTML;


        // Début du survol
        element.addEventListener('mouseenter', function() {
            overlay.style.display = 'block';
        });
        // Fin du survol
        element.addEventListener('mouseleave', function() {
            overlay.style.display = 'none';
        });

        //////////////////////////

        // Clic sur l'oeil pour redirection de page
        oeil.addEventListener('click', function() {
            // Redirection vers la page de la photo
            window.location.href = lienPhoto;
        });
    });

    lightbox();
}