<?php

include ("Handler/Handler.php");
include ("Modelo/Db.php");
//header("Content-Type: application/json; charset=utf-8");
header('Content-Type: application/json; charset=utf-8');
$capturador=new Handler();

 //echo $capturador['tabla']."<br>";

$handlerTabla=$capturador->getTabla();
$handlerParametros=$capturador->getParams();

$file="Modelo/".$handlerTabla.".php";
//aaa
if(file_exists($file)){

    include ($file);

    $objTabla= new $handlerTabla();

 $respuesta= $objTabla->listar();


    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

}else{
    //  echo json_encode($error, JSON_UNESCAPED_UNICODE);
}
