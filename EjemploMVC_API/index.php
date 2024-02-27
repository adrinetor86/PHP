<?php

include ("Handler/Handler.php");
include ("Modelo/Db.php");
//header("Content-Type: application/json; charset=utf-8");
header('Content-Type: application/json; charset=utf-8');
$capturador=new Handler();

 //echo $capturador['tabla']."<br>";
$propiedades=$capturador->getProperties();

$handlerTabla=$propiedades['tabla'] ?? '' ;
$handlerAction=$propiedades['action']?? '' ;
$handlerParametros=$propiedades['parametros'] ?? '';

$file="Modelo/".$handlerTabla.".php";
//aaa
if(file_exists($file)){

    include ($file);
//    echo "TABLA: ".$handlerTabla;
//    echo "ACTION: ".$handlerAction;
//    echo "PARAMETROS: ".$handlerParametros[0];
    $objTabla= new $handlerTabla();

    $respuesta= $objTabla->{$handlerAction}($handlerParametros);


    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}else{
    //  echo json_encode($error, JSON_UNESCAPED_UNICODE);
}
