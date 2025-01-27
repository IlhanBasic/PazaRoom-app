function toggleMenu() {
    var menu = document.getElementById("mobile-menu");
    menu.classList.toggle("show");
}

document.addEventListener("click", function (event) {
    var menu = document.getElementById("mobile-menu");
    var menuButton = document.getElementById("hamburger");

    if (!menu.contains(event.target) && !menuButton.contains(event.target)) {
        menu.classList.remove("show");
    }
});

