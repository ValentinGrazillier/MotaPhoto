// Gestion du menu burger et animation pour passage au design en croix

document.addEventListener("DOMContentLoaded", function () {
    const boutonBurger = document.querySelector(".menu-burger");
    const nav = document.querySelector("nav");
    const lignes = document.querySelectorAll(".ligne");
    const navigationBurger = document.querySelector(".navigation-burger")

    boutonBurger.addEventListener("click", function () {
        if (nav.classList.value.includes("active")) {
            nav.classList.remove("active");
            lignes[0].classList.remove("croixgauche");
            lignes[1].classList.remove("croixdroite");
            lignes[2].style.display = 'block';
            navigationBurger.style.display = 'none';
        }
        else {
        nav.classList.add("active");
        lignes[0].classList.add("croixgauche");
        lignes[1].classList.add("croixdroite");
        lignes[2].style.display = 'none';
        navigationBurger.style.display = 'block';
        }
    });
});
