<?php
//echo"holaaaaa";
$arrDatos=array();
include ("../includes/PDO.inc.php");
foreach ($_REQUEST as $clave =>$valor){

    echo $_REQUEST[$clave].' ';

    array_push($arrDatos,$_REQUEST[$clave]);


}
print_r($arrDatos);

if(insert($arrDatos)){
    echo "Usuario Metido Correctamente";
    //PONER LOS VALORES DEL USER Y PASS
   // header("location: ./login.php");
}
