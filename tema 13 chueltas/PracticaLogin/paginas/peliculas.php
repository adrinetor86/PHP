<?php
session_start();
if($_SESSION['loginCorrecto']==true){
    include("../includes/PelisYSeries.inc.php");


    foreach($arrPeliculas as $peli){
        echo "<p>$peli</p>";
    }
    echo "<a href='../paginas/series.php'>Series &nbsp&nbsp";
    echo "<a href='logout.php'>Cerrar Sesion";
}else{
    header("location: ../index.php");
}
