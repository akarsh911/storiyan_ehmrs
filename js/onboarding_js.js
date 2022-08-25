var f_name = document.getElementById("f_name");
var l_name = document.getElementById("l_name");
var email = document.getElementById("email");
var psw = document.getElementById("psw");
var c_psw = document.getElementById("c_psw");
var f_name_flag = false;
var l_name_flag = false;
var psw_flag = false;
var c_psw_flag = false;
var data = sessionStorage.getItem("err_data");
if (data != "" && data != null) {

    data = JSON.parse(data);
    f_name.value = data.f_name.val;
    l_name.value = data.l_name.val;
    email.value = data.email.val;
    psw.value = data.psw.val;
    c_psw.value = data.c_psw.val;
    check_all();
    if(data.used_email==true)
    {
        msg = "Email already in use with different ID";
        things_bad("email", email);
        var err_msg = document.getElementById("email_err_msg");
        err_msg.innerHTML = msg;
        email.setCustomValidity(msg);
    }
    //TODO: FIll data and handel error
}
function check_all() {
    f_name_key();
    l_name_key();
    email_key();
    psw_key();
    psw_match();
}
function f_name_key() {
    var temp = name_verify(f_name.value);
    f_name_flag = temp;
    console.log(temp);
    if (temp) {
        if (f_name_flag && l_name_flag) { msg = ""; }
        else {
            msg = document.getElementById("f_name_err_msg").innerText;
        }
        things_good("f_name", f_name);
        var err_msg = document.getElementById("f_name_err_msg");
        err_msg.innerHTML = msg;
        f_name.setCustomValidity("");
    }
    else {
        things_bad("f_name", f_name);
        msg = "Please enter name with only letters & greater than 3 characters";
        var err_msg = document.getElementById("f_name_err_msg");
        err_msg.innerHTML = msg;
        f_name.setCustomValidity(msg);
    }

};


function l_name_key() {
    var temp = name_verify(l_name.value);
    l_name_flag = temp;
    console.log(temp);
    if (temp) {
        if (l_name_flag && f_name_flag) { msg = ""; }
        else {
            msg = document.getElementById("f_name_err_msg").innerText;
        }
        things_good("l_name", l_name);
        var err_msg = document.getElementById("f_name_err_msg");
        err_msg.innerHTML = msg;
        l_name.setCustomValidity("");
    }
    else {
        msg = "Please enter name with only letters & greater than 3 characters"
        things_bad("l_name", l_name);
        var err_msg = document.getElementById("f_name_err_msg");
        err_msg.innerHTML = msg;
        l_name.setCustomValidity(msg);

    }
};


function name_verify(name) {
    if (name.length > 2) {
        var regName = /^[A-Za-z]+$/;
        if (!regName.test(name)) {
            //function name bad
            return false;
        } else {
            //function name good 
            return true;
        }
    }
    else {
        return false;
    }

}
function email_key() {
    if (email_verify(email.value)) {
        msg = "";
        things_good("email", email);
        var err_msg = document.getElementById("email_err_msg");
        err_msg.innerHTML = msg;
        email.setCustomValidity(msg);
    }
    else {
        msg = "Please enter a valid mail id";
        things_bad("email", email);
        var err_msg = document.getElementById("email_err_msg");
        err_msg.innerHTML = msg;
        email.setCustomValidity(msg);
    }

}
function email_verify(emailv) {
    return String(emailv)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );

}
function psw_key() {
    var temp = CheckPassword(psw)
    psw_flag = temp;
    if (temp) {
        if (psw_flag && c_psw_flag) { msg = ""; }
        else {
            msg = document.getElementById("psw_err_msg").innerText;
        }
        things_good("psw", psw);
        var err_msg = document.getElementById("psw_err_msg");
        err_msg.innerHTML = msg;
        psw.setCustomValidity("");
        psw_match();
    }
    else {
        msg = "Please enter a password with 7-16 characters , one lower & uppercase & one sp. character";
        things_bad("psw", psw);
        var err_msg = document.getElementById("psw_err_msg");
        err_msg.innerHTML = msg;
        psw.setCustomValidity(msg);
    }
}
function psw_match() {
    if (psw.value == c_psw.value && c_psw.value != "") {
        c_psw_flag = true;
        if (psw_flag && c_psw_flag) { msg = ""; }
        else {
            msg = document.getElementById("psw_err_msg").innerText;
        }
        things_good("c_psw", c_psw);
        var err_msg = document.getElementById("psw_err_msg");
        err_msg.innerHTML = msg;
        c_psw.setCustomValidity("");
    }
    else {
        c_psw_flag = false;
        msg = "Confirm Password should Match"
        if (!psw_flag) {
            msg = "Please enter a password with 7-16 characters , one lower & uppercase & one sp. character";
        }

        things_bad("c_psw", c_psw);
        var err_msg = document.getElementById("psw_err_msg");
        err_msg.innerHTML = msg;
        c_psw.setCustomValidity(msg);
    }
}

function CheckPassword(inputtxt) {
    var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    if (inputtxt.value.match(passw)) {
        return true;
    }
    else {
        return false;
    }
}


function things_good(id, elem) {
    elem.classList.remove("error");
    var err_key = document.getElementById(id + "_err");
    console.log(err_key);
    err_key.classList.remove("fa-exclamation-circle");
    err_key.classList.add("fa-circle-check");
    err_key.classList.add("fa-solid");
    err_key.classList.add("good");
    elem.classList.add("all_good");

}
function things_bad(id, elem) {
    var err_key = document.getElementById(id + "_err");
    console.log(err_key);
    elem.classList.remove("all_good");
    err_key.classList.add("fa-exclamation-circle");
    err_key.classList.remove("fa-circle-check");
    err_key.classList.remove("fa-solid");
    err_key.classList.remove("good");
    err_key.style.visibility = "visible";
    console.log(err_key);
    elem.classList.add("error");
}
