window.addEventListener("scroll", function() {
    var menu = document.querySelector("header .menu");
    menu.classList.toggle("abajo", window.scrollY > 0);
});