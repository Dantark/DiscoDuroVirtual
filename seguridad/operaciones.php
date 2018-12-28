<?php
function connect(){
    include "discodurobd.php";
    $connect=mysqli_connect(IP,USUARIO,CLAVE,BD);
    mysqli_set_charset($connect,"utf8");

    return $connect;
}

function validateConnect($connect){
    if(!$connect){
        echo "Ha ocurrido el error: ".mysqli_connect_errno()." ".mysqli_connect_error($connect)."<br />";
        exit;
    }
}

function userValidate($user, $psw){
    $pswBD = getPsw($user, $psw);
    return $pswBD;
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
    $getPswSelect = "select clave from usuarios where usuario=?";
    $connect = connect();
    validateConnect($connect);
    $getPswQuery = mysqli_prepare($connect, $getPswSelect);
    mysqli_stmt_bind_param($getPswQuery, "s", $userQuery);
    $userQuery = $user;

    mysqli_stmt_execute($getPswQuery);
    mysqli_stmt_bind_result($getPswQuery, $pswBD);
    mysqli_stmt_fetch($getPswQuery);

    
    if(is_null($pswBD)){
        return 0;
    }else if(!password_verify($psw, $pswBD)){
        return 1;
    }else if(password_verify($psw, $pswBD)){
        return 2;
    }
    mysqli_stmt_close($getPswQuery);
    mysqli_close($connect);
}

function createSession($user){
	session_name("SESION");
	session_cache_limiter('nocache');
    session_start();

	$_SESSION['user']=$user;
}


function getFiles(){
/*     $connect = connect();
    validateConnect($connect);
    $getFilesSelect =  */
}

/* function upFiles(){
    $filesCount = count($_FILES['files']['name']);

    $connect = connect();
    validateConnect($connect);

    $insertFilesSelect = "insert into discos (id, tamanyo, tipoMime, tipoFichero, usuario, id_depende) values (?,?,?,?,?,?)";
    $insertFilesQuery = prepare($connect, $insertFilesSelect);
    mysqli_stmt_bind_param($insertFilesQuery, "ssdssss", $id, $size, $mime, $type, $user, $id_depend);

    for($i=0;$i<$filesCount;$i++){
        switch ($_FILES['files']['error'][$i]) {
            case UPLOAD_ERR_OK:
            $id=uniqid('',true);
            $fileDirectory =$route.$id;
            
			if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $fileDirectory)) {
				$message.=basename($_FILES['files']['name'][$i])." subido con éxito. ";
                $size = $_FILES['files']['size'][$i];
                $mime = null;
                $type = $_FILES['files']['type'][$i];
                $user = $_SESSION['user'];
                $id_depend = null;
                mysqli_stmt_execute($insertFilesQuery);
			} else {
				$message.=basename($_FILES['files']['name'][$i])." error desconocido. ";
			}
            break;
        
            case UPLOAD_ERR_NO_FILE:
                $message.=basename($_FILES['files']['name'][$i])." no existe. ";
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $message.=basename($_FILES['files']['name'][$i])." excede el límite. ";
            default:
                $message.=basename($_FILES['files']['name'][$i])." error desconocido. ";
        }
    }

    mysqli_stmt_close($consulta);
    mysqli_close($canal);
} */


function upFile($file, $connect){
    $fileName = $file['name'];
    $fileSize = $file['size'];
    $fileType = $file['type'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    $message = "";

    switch ($fileError) {
        
        case UPLOAD_ERR_OK:

        $getIdSelect = "select id from disco where usuario=? and id_depende IS NULL";
        $getIdQuery = mysqli_prepare($connect, $getIdSelect);
        mysqli_stmt_bind_param($getIdQuery, "s", $userQuery);
        $userQuery = $_SESSION['user'];
        

        mysqli_stmt_execute($getIdQuery);
        mysqli_stmt_bind_result($getIdQuery, $id_result);
        mysqli_stmt_fetch($getIdQuery);

        mysqli_stmt_close($getIdQuery);
        
        
        


        $insertFilesSelect = "insert into disco (id, nombre, tamanyo, tipoMime, tipoFichero, usuario, id_depende) values (?,?,?,?,?,?,?)";
        $insertFilesQuery = mysqli_prepare($connect, $insertFilesSelect);
        mysqli_stmt_bind_param($insertFilesQuery, "ssdssss", $id, $name, $size, $typeMime, $typeFich, $user, $id_depend);

        $id=uniqid('',true);
        $fileDirectory=route.$id;
        
        if (move_uploaded_file($fileTmpName, $fileDirectory)) {
            $message.=basename($fileName)." subido con éxito. ";
            $name = $fileName;
            $size = $fileSize;
            
            $typeMime = $fileType;
            $typeFich = "F";
            $user = $_SESSION['user'];
            $id_depend = $id_result;
            mysqli_stmt_execute($insertFilesQuery);

            if(!$insertFilesQuery){
                print_r("Ha ocurrido el error: ".mysqli_errno($connect)."".mysqli_error($connect)."<br />");
                exit;
            }
            
        } else{
            $message.=basename($fileName)." error desconocido. ";
        }
        break;
    
        case UPLOAD_ERR_NO_FILE:
            $message.=basename($fileName)." no existe. ";
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            $message.=basename($fileName)." excede el límite. ";
        default:
            $message.=basename($fileName)." error desconocido. ";
    }
    mysqli_stmt_close($insertFilesQuery);
    
    return $message;
}
