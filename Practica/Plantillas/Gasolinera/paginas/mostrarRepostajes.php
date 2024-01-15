<?php
$strTitulo="REPOSTAJES";
include ("../includes/mainMostrarRepostajes.inc.php");

if(isset($_REQUEST['volver'])){
    header("location: ../index.php");
}