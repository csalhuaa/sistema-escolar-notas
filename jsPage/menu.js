window.addEventListener("scroll", function() {
    var menu = document.querySelector("header .menu");
    menu.classList.toggle("abajo", window.scrollY > 0);
});

document.addEventListener('DOMContentLoaded', function() {
    const menuDesglos = document.querySelector('.menu-desglos');
    const menu = document.querySelector('.menu ul');

    menuDesglos.addEventListener('click', function() {
        menu.classList.toggle('active');
    });
});