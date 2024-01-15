<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="formulario.php" method="get">

dia <select name="dia">

<?php

for($intCont=1;$intCont<=31;$intCont++){

    echo"<option value='$intCont'";
if(isset($_GET['dia'])&& $_GET['dia']==$intCont){
  
    echo" selected>".$_GET['dia']."</option>";
}
    echo" >$intCont</option>";
}

?>
</select>


 mes <select name="mes">
 <?php
 
 for($intCont=1;$intCont<12;$intCont++)
 echo "<option value='$intCont'>$intCont</option>"

 ?>  
 </select>

<?php 
 $intDia=$_GET['dia'];
 $intMes=$_GET['mes'];
 //$intAño=$_GET['año'];
 echo "<br/>";
 echo "$intDia/ $intMes /";
 ?>

 <input type="submit">
</form>    


</body>
</html>