<?php
function connect(){
    include "discodurobd.php";
    $canal=@mysqli_connect(IP,USUARIO,CLAVE,BD);
    mysqli_set_charset($canal,"utf8");
    if (!$comprobar){
        echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error($comprobar)."<br />";
        exit;
     }
    return $canal;
}

function userValidate($user, $psw){
    $pswBD = getPsw($user, $psw);
    if($pswBD==false){
        return "error0";
    }

    if($pswBD!=$psw){
        return "error1";
    }else{
        return true;
    }

    
}

function getPsw($user, $psw){
    $getPswSelect = "select usuario,clave from usuarios where usuario=?";
    $connect = connect();
    $getPswQuery = mysqli_prepare($connect, $getPswSelect);
    mysqli_stmt_bind_param($getPswQuery, "s", $userQuery);
    $userQuery = $user;

    mysqli_stmt_execute($getPswQuery);
    mysqli_stmt_bind_result($getPswQuery, $pswBD);
    mysqli_stmt_fetch($getPswQuery);

    return $pswBD;
}

function createSession($user){
	session_name("SESION");
	session_cache_limiter('nocache');
    session_start();
    
    $_SESSION['valid']=true;
	$_SESSION['user']=$user;
}

function DiscoDuro(){
    return "principal.html";
}

/* 
function DiscoDuro(){

}

function mostrarDatos(){

}

function borrarFichero(){

}

function descargaFichero(){

}

function cerrarSesion(){
    
} */