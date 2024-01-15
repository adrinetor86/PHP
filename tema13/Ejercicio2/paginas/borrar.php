<?php

if(isset($_REQUEST['id'])){
    include ("../includes/PDO.inc.php");
    $id = $_REQUEST['id'];

    delete($id);
    header("location: ../index.php");
}

