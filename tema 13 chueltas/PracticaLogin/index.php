<?php
session_start();
session_destroy();
session_start();
$_SESSION['Adrian']='adrian';
$_SESSION['Juan']='juan';

include ("includes/cabecera.inc.php");
include ("./includes/formulario.inc.php");
include ("includes/pie.inc.php");