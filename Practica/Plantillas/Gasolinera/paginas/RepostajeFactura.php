<?php
include ("../includes/mainRepostajeFactura.inc.php");
include ("../includes/PDO.inc.php");


    if(isset($_REQUEST['importe']) && isset($_REQUEST['dni']) && isset($_REQUEST['matricula'])
    && $_REQUEST['importe']!='' && $_REQUEST['dni']!='' && $_REQUEST['matricula']!=''){

    $importe=$_REQUEST['importe'];
    $strDni=$_REQUEST['dni'];
    $strMatricula=$_REQUEST['matricula'];
        $_SESSION['Operacion']='Factura';
    $factura= new factura(intval($importe),$strDni,$strMatricula);
        insertFactura($factura->meterArr());
    /*
       echo $factura->getFecha()."// ";
    echo $factura->getHora()."// ";
    echo $factura->getImporte()."// ";
    echo $factura->getDni()."// ";
    echo $factura->getMatricula();

    print_r($factura->meterArr());
    */
    }else if(isset($_REQUEST['volver'])){
    header("location: ../index.php");
    }