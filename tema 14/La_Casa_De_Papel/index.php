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

    echo $file."<br>";
//print_r($handlerParametros);echo"<br>";
    if(file_exists($file)){

        include ($file);

        $objTabla= new $handlerTabla();

       $respuesta= $objTabla->getValores($handlerParametros);


      //  echo API

    echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        // $strTablaHandler=$capturador->get;
    }else{
      //  echo json_encode($error, JSON_UNESCAPED_UNICODE);
    }


//
//$strTablaHandler="";
