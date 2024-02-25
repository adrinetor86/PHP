<?php

include_once("handler.php");
include ("Db.php");
//header('Content-Type: application/json; charset=utf-8');
$capturador = new Handler();


//   print_r($capturador['tabla']);echo "<br>";

$handlerTabla = $capturador->getTabla();
$handlerParametros = $capturador->getParams();

//MODIFICAR ESTO EN CUESTION DONDE ESTA EL MODELO
$file =  $handlerTabla . ".php";

if (file_exists($file)) {

    include($file);

    $objTabla = new $handlerTabla();

    $respuesta = $objTabla->getValores($handlerParametros);

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

} else {
    //  echo json_encode($error, JSON_UNESCAPED_UNICODE);
    echo "No existe el archivo";
}


