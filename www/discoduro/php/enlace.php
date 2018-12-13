<?php
include "../../../../seguridad/CarritoCompraFinal/operaciones.php";

$option = $_POST["option"];

if($option == "login"){
    $user = strip_tags(trim($_POST["user"]));
    $psw = strip_tags(trim($_POST["pwd"]));
    $validate = userValidate($user, $psw);

    if($validate == "error0"){
        $result = "Usuario no encontrado";
    }else if($validate=="error1"){
        $result = "Contraseña Incorrecta"
    }else if($validate==true){
        createSession($user);
        DiscoDuro();
    }
    echo json_encode($result);
}
/* validarUsuario(); */
