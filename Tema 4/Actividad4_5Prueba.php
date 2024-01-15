<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>


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
   
    $intAciertos=0;
    $intFallos=0;
    for($intCont=0;$intCont<5;$intCont++){
        $intRespuesta=$_GET['texto'.$intCont];
    

    if($intRespuesta==($strArrPalabras[$intRespuesta])){
        $intFallos++;
    }else{
        $intAciertos++;
    }
    }
    echo "</br>";
echo "Aciertos: ".$intAciertos;
echo "</br>";
echo "Fallos: ".$intFallos;
   ?>


    
</body>
</html>