<?php
$strTitulo="FORMULARIO DEPOSITO GASOLINA";
include("../includes/mainDepositoGasolina.inc.php");


    if(isset($_REQUEST['tipoGasolina']) && isset($_REQUEST['litros']) && isset($_REQUEST['importe'])
        && $_REQUEST['tipoGasolina']!='' && $_REQUEST['litros']!='' && $_REQUEST['importe']!=''){
        $_SESSION['Operacion']='llenado';

       $_SESSION['TipoGaso']=$_REQUEST['tipoGasolina'];
        foreach ($_REQUEST as $clave=>$valor){
            echo $clave.'&nbsp  '.$valor.'<br>';
            $arrDeposito[$clave]=$valor;
        }
        insertDeposito($arrDeposito);
    }
    if(isset($_REQUEST['volver'])){
    header("location: ../index.php");
}