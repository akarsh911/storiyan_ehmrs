function login() {
    var chng = document.getElementById("box1");
    fetch('../html/login_set.html')
        .then(response => response.text())
        .then(text => document.getElementById('box1').innerHTML = text);

}