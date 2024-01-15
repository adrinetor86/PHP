<?php
session_start();

if($_SESSION['loginCorrecto']==true){
include("../includes/PelisYSeries.inc.php");

foreach($arrSeries as $serie){
    echo "<p>$serie</p>";
}
echo "<a href='peliculas.php'>Peliculas";
echo "<a href='logout.php'>Cerrar Sesion";

}else{
    header("location: ../index.php");
}