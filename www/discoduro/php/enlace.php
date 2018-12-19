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
    $mensaje = "";

   /* print_r($_FILES['file0']); */

     for($i = 0; $i<$_POST["contFiles"];$i++){
        
        $mensaje = upFile($_FILES["file".$i]);
    }
    
    
    echo json_encode($mensaje);
}

