<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="Actividad4_3.php" method="get">

    <?php

    echo "Pon la palabra que quieras taducir:<input type='text' name='texto'>";
    
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

    $strPalabra=$_GET['texto'];
        for($intCont=0;$intCont<count($strArrPalabras);$intCont++){

            
           if($strPalabraIngles=$strArrPalabras[$strPalabra]){
         
           } 
           
        }
        echo"<br/>";
  
    ?>

    <input type="submit">

        <?php
        if(isset($_GET['texto'])?$strPalabraIngles:null){
            echo"$strPalabraIngles";
        }
        ?>

    </form>
</body>
</html>