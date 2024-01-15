<?php
session_start();
include ("../includes/PDO.inc.php");
//if($_SESSION['TipoGaso']=)

if(isset($_SESSION['Operacion']) && $_SESSION['Operacion']=='llenado'){
    //echo "q tal";
    if(borrarDeposito()==true){
        header("location: ../index.php");
    };
}else{
    echo "Solo se puede borrar si el ultimo registro ha sido un llenado de deposito";
}