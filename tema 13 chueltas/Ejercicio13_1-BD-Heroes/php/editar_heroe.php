<?php
if (isset($_REQUEST['id'])) {
    include('../includes/PDO.inc.php');
    $id = $_REQUEST['id'];
    $strRutaCss = '../css/stylesEdit.css';
    $strTitulo = 'Editar héroes';

    include('../includes/cabecera.inc.php');
    include('../includes/mainEditar.inc.php');
    include('../includes/pie.inc.php');
} else {
    header('Location: ../index.php');
}
