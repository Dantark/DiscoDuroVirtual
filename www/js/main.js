/* -----------------------------------------------------
                Asigancion de eventos 
   -----------------------------------------------------
*/
window.addEventListener("load", events)

function events(){
    document.getElementById("submitFiles").addEventListener("click", upFiles);
    getFiles();
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
    var message = "";
    for(let i = 0; i<notify.length; i++){
        message += notify[i]+"\n";
    }
    alert(message);
} 

function getFiles(){

}
