function nav_fold() {
    var html = document.getElementById('data_html');
    var nav = document.getElementById('navigation_container');
    if (nav.classList.contains("thin")) {
        nav.classList.remove("thin");
        html.classList.remove("thin");
    }
    else {
        nav.classList.add("thin");
        html.classList.add("thin");
    }
}

document.getElementById('fold').addEventListener('click', function (e) {
    nav_fold();
});
