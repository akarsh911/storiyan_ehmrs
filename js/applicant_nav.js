addEventListener('hashchange', (event) => { });
onhashchange = (event) => {
    console.log(location.hash);
    var target = document.getElementsByTagName("body")[0];
    var chng = document.getElementById("data_html");
    $.ajax(
        {
            url: '../php/applicant_dashboard.php?ref=app',
            dataType: "html",
            success: function (data) {
                chng.innerHTML = data;
                var scripts = chng.getElementsByTagName("script");
                console.log(scripts);
                for (var i = 0; i < scripts.length; i++) {
                    var newScript = document.createElement("script");
                    newScript.src = scripts[i].src;
                    target.appendChild(newScript);
                }

            },
            error: function (e) {
                alert('Error: ' + e);
            }
        });
};
