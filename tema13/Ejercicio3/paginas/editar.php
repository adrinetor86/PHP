
<?php


if(isset($_REQUEST['id'])){

    include ("../includes/PDO.inc.php");
    $id = $_REQUEST['id'];

    $strTitulo = 'Editar héroes';

    include('../includes/cabecera.inc.php');
    include ("../includes/mainEditar.inc.php");
    include ("../includes/pie.inc.php");
}else{
    echo"hola";
   // include ("../includes/mainIndex.inc.php");
    header ("./login.php");
   //header("Location: ../includes/mainIndex.inc.php");
}



