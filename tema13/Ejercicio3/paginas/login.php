<?php

session_start();
include("../includes/PDO.inc.php");
$strTitulo="Ejercicio";
if(isset($_REQUEST['user']) && isset($_REQUEST['pass'])){


    $usuario=$_REQUEST['user'];
    $contraseña=$_REQUEST['pass'];

    $_SESSION[$usuario]=$contraseña;

    if(comprobarCredenciales($usuario,$contraseña)==true){
        include ("../includes/mainIndex.inc.php");
    }else{
        echo "Debes meter un usuario y contraseña validos ";
    }

    //include ("../includes/mainIndex.inc.php");
}
