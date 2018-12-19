<?php

    session_name("SESION");
    session_cache_limiter('nocache');
    session_start();

    if(!isset($_SESSION['user'])){
        session_destroy();
        unset($_SESSION);
        header("Location: index.php");
        exit;
    }else{
        $user=$_SESSION['user'];
    }
