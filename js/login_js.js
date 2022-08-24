function change_pwd() {
    var chng = document.getElementById("chng");
    var but = document.getElementById("pwd");
    if (but.type == "password") {
        chng.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
        but.type = "text";
    }
    else {
        chng.innerHTML = '<i class="fa fa-eye"></i>';
        but.type = "password";
    }
}
function fg_pwd() {
    var chng = document.getElementById("box1");
    fetch('../html/forgot_psw.html')
        .then(response => response.text())
        .then(text => document.getElementById('box1').innerHTML = text);
}
function login()
{
    var chng = document.getElementById("box1");
    fetch('../html/login_set.html')
        .then(response => response.text())
        .then(text => document.getElementById('box1').innerHTML = text);

}