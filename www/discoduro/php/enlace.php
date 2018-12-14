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
        $result = "Inicio de sesion correcto";
    } 
    echo json_encode($result);
}
/* validarUsuario(); */
