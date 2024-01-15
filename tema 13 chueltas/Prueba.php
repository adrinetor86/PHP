<?php

$strConsulta= "Select EMP_NO,APELLIDO from emple";




try {
    $conexion =new PDO("mysql:host=localhost;port=3307;dbname=emple","root","");
    $conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sentencia = $conexion->prepare($strConsulta);
    $sentencia -> setFetchMode(PDO::FETCH_ASSOC);
    $sentencia -> execute();


    while ($arrEmpleados =$sentencia ->fetch()){

        foreach ($arrEmpleados as $key=>$valor){
            echo "$key: $valor";
            echo "<br>";
        }
    }
}catch (PDOException $e){
    echo 'error SQL ' . $e->getMessage();
}




?>