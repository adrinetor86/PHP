<?php

function generarConnexion(){
    $strGestorBd = 'mysql';
    $strHost = 'localhost';
    $strPuerto = '3307';
    $strDbname = 'pruebas';
    $strUser = 'root';
    $strPass = '';


    try {

        $conexion = new PDO(
            $strGestorBd . ':host=' . $strHost . ';port=' . $strPuerto .';dbname='. $strDbname,
            $strUser,
            $strPass
        );
    $conexion ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $conexion;

    } catch (PDOException $e) {
        echo "Error en la conexion " . $strDbname;

        return null;
    }

}


$conexion=generarConnexion();
$strConsulta="Select Apellido from emple";


$sentencia=$conexion->prepare($strConsulta);
$sentencia-> setFetchMode(PDO::FETCH_ASSOC);
$sentencia -> execute();

while($arrEmpleados=$sentencia->fetch()){
    foreach ($arrEmpleados as $key){
        echo $key."<br>";
    }
}


?>