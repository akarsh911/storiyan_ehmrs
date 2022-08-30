function nav_fold() {

    var nav = document.getElementById('navigation_container');
    if (nav.classList.contains("thin")) {
        nav.classList.remove("thin");
    }
    else {
        nav.classList.add("thin");
    }
}

document.getElementById('fold').addEventListener('click', function (e) {
    nav_fold();
});