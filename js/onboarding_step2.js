var pin_elem = document.getElementById("pin");
var tel_elem = document.getElementById("tel");
function tel_key() {
    var code = document.getElementById("tel").value;
    if (code.length == 10) {
        let isnum = /^\d+$/.test(code);
        if (isnum) {
            things_good('tel', tel_elem);
            msg = "";
            var err_msg = document.getElementById("tel_err_msg");
            err_msg.innerHTML = msg;
            pin_elem.setCustomValidity("");
        }
        else {
            things_bad('tel', tel_elem);
            msg = "Please enter only 10 digits phone number";
            var err_msg = document.getElementById("tel_err_msg");
            err_msg.innerHTML = msg;
            pin_elem.setCustomValidity(msg);
        }
    }
    else {
        things_bad('tel', tel_elem);
        msg = "Please enter only 10 digits phone number";
        var err_msg = document.getElementById("tel_err_msg");
        err_msg.innerHTML = msg;
        pin_elem.setCustomValidity(msg);
    }
}
function pin_key() {

    var code = document.getElementById("pin").value;
    if (code.length == 6) {
        let isnum = /^\d+$/.test(code);
        if (isnum) {
            fill_loc(code);
            things_good('pin', pin_elem);
            msg = "";
            var err_msg = document.getElementById("pin_err_msg");
            err_msg.innerHTML = msg;
            pin_elem.setCustomValidity("");
        }
        else {
            things_bad('pin', pin_elem);
            msg = "Please enter only 6 digits pincode";
            var err_msg = document.getElementById("pin_err_msg");
            err_msg.innerHTML = msg;
            pin_elem.setCustomValidity(msg);
        }
    }
    else {
        things_bad('pin', pin_elem);
        msg = "Please enter only 6 digits pincode";
        var err_msg = document.getElementById("pin_err_msg");
        err_msg.innerHTML = msg;
        pin_elem.setCustomValidity(msg);
    }
}
function fill_loc(zipCode) {
    var stateName = '';
    var cityName = '';
    $.ajax(
        {
            url: 'https://api.postalpincode.in/pincode/' + zipCode,
            //dataType: "JSON",
            success: function (data) {
                data = data[0];
                console.log(data.Status);
                if (data.Status == "Success") {
                    cityName = data.PostOffice[0].District;
                    console.log(cityName);
                    stateName = data.PostOffice[0].State;
                    document.getElementById("city").value = cityName;
                    document.getElementById("state").value = stateName;
                    things_good('city', document.getElementById("city"));
                    things_good('state', document.getElementById("state"));
                    things_good('pin', pin_elem);
                    msg = "";
                    var err_msg = document.getElementById("pin_err_msg");
                    err_msg.innerHTML = msg;
                    pin_elem.setCustomValidity("");

                }
                else {
                    things_bad('pin', pin_elem);
                    msg = "Enter a valid pin code";
                    var err_msg = document.getElementById("pin_err_msg");
                    err_msg.innerHTML = msg;
                    pin_elem.setCustomValidity(msg);

                }

            },
            error: function (e) {
                alert('Error: ' + e);
            }
        });



}


function things_good(id, pin_elem) {
    pin_elem.classList.remove("error");
    var err_key = document.getElementById(id + "_err");
    console.log(err_key);
    err_key.classList.remove("fa-exclamation-circle");
    err_key.classList.add("fa-circle-check");
    err_key.classList.add("fa-solid");
    err_key.classList.add("good");
    pin_elem.classList.add("all_good");

}
function things_bad(id, pin_elem) {
    var err_key = document.getElementById(id + "_err");
    console.log(err_key);
    pin_elem.classList.remove("all_good");
    err_key.classList.add("fa-exclamation-circle");
    err_key.classList.remove("fa-circle-check");
    err_key.classList.remove("fa-solid");
    err_key.classList.remove("good");
    err_key.style.visibility = "visible";
    console.log(err_key);
    pin_elem.classList.add("error");
}
