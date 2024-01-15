<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/arrayFuncionesCss.CSS">
</head>
<body>
    <form action="arrayFunciones.php" method="get"> 
<div id="bloque1">
  Numero 1 <input type="number" name="numeroA"><br/>
  Numero 2 <input type="number" name="numeroB"><br/>
</div>
  <input type="submit" id="enviar"><br/>
    <?php
      include('biblioteca.inc.php');
      $numA=$_GET['numeroA'];
      $numB=$_GET['numeroB'];

      $arrayBiblio=['sumar','restar','multiplicar','dividir'];

    foreach($arrayBiblio as $valor){
//        echo $valor($numA,$numB)."<br/>";
        echo "<p id='Parrafo'>La funcion ". $valor . " devuelve ".$valor($numA,$numB)."</p>";

    }
    ?>

    </form>
</body>
</html>