<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>

<body>
<form action="Actividad4_5Prueba.php" method="get">

<?php

$strArrPalabras=[
    'Hola'=>'Hello',
    'Adios'=>'Bye',
    'Elefante'=>'Elephant',
    'Galleta'=>'Cookie',
    'Mama'=>'Mum',
    'Papa'=>'Dad',
    'Tienda'=>'Shop',
    'Persona'=>'Person',
    'Camisa'=>'T-shirt',
    'Comida'=>'Food'];


   // echo "Pon la palabra que quieras taducir:<input type='text' name='texto'>";

    $ArrEsp=[];
    foreach($strArrPalabras as $strEsp=>$strIng){
        $ArrEsp[]=$strEsp;

        
    }
    echo "<br/>";

    
 
   
    for($intCont=0;($intCont<5);$intCont++){
    
      $intIndice= rand(0,count($ArrEsp));

        echo"Traduce ".$ArrEsp[$intIndice]." <input type='text' name='texto".$intCont."'> </br>";
      }

?>
<input type="submit"></input>

<?php



?>
</form>

    
</body>
</html>