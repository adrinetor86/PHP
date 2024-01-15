<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
   <!-- <style>
         body{
        background-color: <?php  echo $_SESSION['colorFondo']?>;
         }
    </style>  -->
</head>


<?php
session_start();
if(isset($_SESSION['colorFondo']))
    echo "<body bgcolor=\"".$_SESSION['colorFondo']."\">";  
$arrColores=[
    'blue'=> 'azul',
    'red'=> 'rojo',
    'green'=> 'verde',
];
echo "<div id=\"contenedor\">"; 

?>
 
    <form method="get" action="Ejercicio3.php"> 

   <div>
    <select name='colores'>
         <option value="">Selecciona el fondo</option> 
    <?php

       
    foreach($arrColores as $clave => $valor) {
     
        echo '<option value="' .$clave. '"';
        if(isset($_SESSION['colorFondo']) && $_SESSION['colorFondo'] == $clave &&
        isset($_REQUEST['Confirmar'])){
        
            $_SESSION['colorFondo']= $clave;
            header("location:Ejercicio3.php");
          
        }
        if(isset($_SESSION['colorFondo']) && $_SESSION['colorFondo'] == $clave){
           echo 'selected';
        
        }
    
            echo ' > '.$valor.'</option>';
    }
    
    ?>
</select>

</div>
    
        <button type="submit" name="Confirmar">Confirmar</button>
        <a href="Ejercicio3_1.php">NuevaPagina</a>
 
</div>
    </form>

    <?php
//$color='';
   

    if(isset($_REQUEST['colores'])&& !empty($_REQUEST['colores'])){
        $color = $_REQUEST['colores'];
        $_SESSION['colorFondo'] = $color;

    }
    
    ?>
</body>
</html>