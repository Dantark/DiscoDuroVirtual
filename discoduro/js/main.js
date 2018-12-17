
window.addEventListener("load", events);

function events(){
    if(window.name=="index"){
        alert(window.name);
        document.getElementById("enviar").addEventListener("click", validate);
        
    }else if(window.name=="principal"){
        alert(window.name);
        document.getElementById("submitFiles").addEventListener("click", upFiles);
        
    }
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
    console.log(anserw.srcElement.responseText);
    var notify = JSON.parse(anserw.srcElement.responseText);    
    
    if(notify==true){
        DiscoDuro();
    }else{
        alert(notify);
    }   
}

function DiscoDuro(){
    location.href ="principal.html";

   /*  var showcase = 
    document.getElementById("files").innerHTML=(showcase); */
}

function upFiles(){
    var files = document.getElementById("files").value;
    alert(files);
}