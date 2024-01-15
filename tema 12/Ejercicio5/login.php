<?php

    session_start();
    $credenciales=false;


    foreach($_SESSION as $usuario => $contra){
        if($usuario==$_REQUEST['usuario'] &&  $contra==$_REQUEST['contraseña']){
            $credenciales=true;
        }

        if($credenciales){
    
            header("location:index.php?vista=home");
            echo"hola";
        }else{
            header("location:index.php?access=$blnBandera");
            echo"mal";
        }
        

    }



?>
