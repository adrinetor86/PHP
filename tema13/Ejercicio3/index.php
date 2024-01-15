<?php

include ("./includes/PDO.inc.php");
$strRutaCss = './CSS/style.css';


$strTitulo="EJERCICIO HEROES";
include ("./includes/cabecera.inc.php");
include ("./includes/formulario.inc.php");
include ("./includes/pie.inc.php");


/*
 * Primero hacer el include a formulario, despues a login pa comprobar y luego a mainIndex
 * include ("./includes/mainIndex.inc.php");
 *include ("./includes/formulario.inc.php");
 * */