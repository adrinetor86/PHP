<?php

session_start();
if(isset($_REQUEST['id'])){
    include ("login.php");
   // echo $_REQUEST;
    update($_REQUEST);
}
foreach ($_SESSION as $usuario =>$contraseña){
    echo $usuario.' '. $contraseña;
}

header('Location: ./usuario.php?user='.$usuario.'&pass='.$contraseña);

