window.addEventListener("load", events);

function events(){
    document.getElementById("enviar").addEventListener("click", validate);
}


function validate(){
    var user = document.getElementById("usuario").value;
    var pwd = document.getElementById("clave").value;
    if(user.length>0&&user.length<=25){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.addEventListener('load', showResult, false);
        xmlhttp.addEventListener('error', function () {
        alert('Fallo en la conexion con la base de datos');
        }, false);
        
        var data = new FormData();
        data.append("option", "login");
        data.append("user", user);
        data.append("pwd", pwd);
        xmlhttp.open("POST", "php/enlace.php", true);
        xmlhttp.send(data);
    }
    
}

function showResult(anserw){
    var user = JSON.parse(anserw.srcElement.responseText);    
    alert(user);
}