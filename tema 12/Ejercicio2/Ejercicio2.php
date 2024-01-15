<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="desplegable.js" defer></script>
    <title>Document</title>
    <style>
         body{
        background-color: <?php  echo $_COOKIE['colorFondo']?>;
         }
    </style>
</head>
<body>


<?php
//header("location:./Ejercicio2.php");
//echo "<body style=background-color:".$_COOKIE['colorFondo'].";";
$arrColores=[
    'blue'=> 'azul',
    'red'=> 'rojo',
    'green'=> 'verde',
];
echo "<div id=\"contenedor\">"; 

?>

    <form method="get">

   <div>
    <select name='colores'>
         <option value="">Selecciona el fondo</option> 
    <?php

       
    foreach($arrColores as $clave => $valor) {
     
        echo '<option value="' .$clave. '"';
        if(isset($_COOKIE['colorFondo']) && $_COOKIE['colorFondo'] == $clave &&
        isset($_REQUEST['Confirmar'])){
        
            setcookie('colorFondo', $clave, time()+86400);
            header("location:Ejercicio2.php");
          
        }
        if(isset($_COOKIE['colorFondo']) && $_COOKIE['colorFondo'] == $clave){
            echo ' selected ' ;
        }
            
        echo ' > '.$valor.'</option>';
     
    }
    ?>
</select>

</div>
    
        <button type="submit" name="Confirmar">Confirmar</button>
 
</div>
    </form>

    <?php
//$color='';
   

    if(isset($_REQUEST['colores'])&& !empty($_REQUEST['colores'])){
        $color = $_REQUEST['colores'];
        setcookie('colorFondo', $color, time()+86400);
    }
    
    ?>
</body>
</html>