<?php
include "../../../../seguridad/discoduro/operaciones.php";

$option = $_POST["option"];

if($option == "login"){
    $user = strip_tags(trim($_POST["user"]));
    $psw = strip_tags(trim($_POST["pwd"]));
    $validate = userValidate($user, $psw);
 
    if($validate == 0){
        $result = "Usuario no encontrado";
    }else if($validate==1){
        $result = "Contraseña Incorrecta";
    }else if($validate==2){
        createSession($user);
        $result = true;
    } 
    echo json_encode($result);
}
if($option == "uploadFiles"){
    $connect = connect();
    validateConnect($connect);

    session_name("SESION");
    session_cache_limiter('nocache');
    session_start();
    $arrayMenssages = array();
    $message = "";

     for($i = 0; $i<$_POST["contFiles"];$i++){
        
        $message = upFile($_FILES["file".$i], $connect);
        array_push($arrayMenssages, $message);
    }
    
    mysqli_close($connect);
    
    echo json_encode($arrayMenssages);
}

