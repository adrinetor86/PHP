<?php
session_start();

if(isset($_REQUEST['user']) && isset($_REQUEST['pass'])){

    foreach ($_SESSION as $usuario => $contraseña){
        if($_REQUEST['user']==$usuario && $_REQUEST['pass']==$contraseña){
            $_SESSION['loginCorrecto']=true;

               header("location: ./peliculas.php");
        }
    }

    //header("location: ./paginas/logout.php");
}

