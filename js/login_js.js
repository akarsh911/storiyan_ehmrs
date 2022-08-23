function change_pwd()
{
    var chng=document.getElementById("chng");
    var but=document.getElementById("pwd");
    if(but.type=="password")
    {
        chng.innerHTML='<i class="fa-solid fa-eye-slash"></i>';
        but.type="text";
    }
    else{
        chng.innerHTML='<i class="fa fa-eye"></i>';
        but.type="password";
    }
}