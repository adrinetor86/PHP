<?php



if(isset($_REQUEST['id'])){
    include ("../includes/PDO.inc.php");
   // echo $_REQUEST;
    update($_REQUEST);
}
header('Location: ../index.php');
