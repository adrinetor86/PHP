<?php
$strTitulo = 'IMPORTE TOTAL';
include ("../includes/mainMostarImporteTotal.inc.php");


if(isset($_REQUEST['volver'])){
    header("location: ../index.php");
}