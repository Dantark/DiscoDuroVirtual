/* -----------------------------------------------------
                Asigancion de eventos 
   -----------------------------------------------------
*/
window.addEventListener("load", events)

function events(){
    document.getElementById("submitFiles").addEventListener("click", upFiles);
}

function upFiles(){
    
    var filesUpload = document.getElementById("files");
    var files = filesUpload.files;

    var contFiles = files.length;
    var data = new FormData();
    data.append("option", "uploadFiles");
    data.append("contFiles", contFiles)

    for(let i=0; i<files.length; i++){
        data.append("file"+i, files[i]);
    }
    
    
    

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.addEventListener('load', showResult, false);
    xmlhttp.addEventListener('error', function () {
    alert('Fallo en la conexion con la base de datos');
    }, false);
    xmlhttp.open("POST", "php/enlace.php", true);
    xmlhttp.send(data);
}

 function showResult(anserw){
    console.log(anserw.srcElement.responseText);
    var notify = JSON.parse(anserw.srcElement.responseText);
    alert(notify)
} 

function utf8_to_b64( str ) {
    return window.btoa(unescape(encodeURIComponent( str )));
}