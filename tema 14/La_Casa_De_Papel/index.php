<?php

include ("Handler/handler.php");
include ("Modelo/db.php");
//header("Content-Type: application/json; charset=utf-8");
header('Content-Type: application/json; charset=utf-8');
    $capturador=new Handler();

  //  echo $capturador['tabla']."<br>";

    $handlerTabla=$capturador->getTabla();
    $handlerParametros=$capturador->getParams();


    $file="Modelo/".$handlerTabla.".php";

    if(file_exists($file)){

        include ($file);

        $objTabla= new $handlerTabla();

       $respuesta= $objTabla->getValores($handlerParametros);


    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);

    }else{
      //  echo json_encode($error, JSON_UNESCAPED_UNICODE);
    }


