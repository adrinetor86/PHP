<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
session_start();

$_SESSION['Adrian']="adrian";
$_SESSION['Juan']="juan";

?>


<?php
if(!isset($_REQUEST['vista'])){
    include("formulario.php");
}else{
    $vista = $_REQUEST["vista"];
    include($vista.".php");
}

?>
</body>
</html>