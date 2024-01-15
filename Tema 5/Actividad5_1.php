<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
      echo "<table border='1px'>";
      echo "<td coles>Nombre</td> <td>".$_REQUEST["nombre"]."</td></br><tr>";
      echo "<td>Apellido</td><td>".$_REQUEST["apellido"]. "</td></br><tr>";
      echo "<td>Email</td><td>".$_REQUEST["email"]. "</td></br><tr>";
      echo "<td>Url</td><td>".$_REQUEST["url"]. "</td></br><tr>";
      echo "<td>Sexo</td><td>".$_REQUEST["sexo"]. "</td></br><tr>";
      echo "<td>Nº Conv</td><td>".$_REQUEST["convivientes"]. "</td></br><tr>";

    $array=$_REQUEST["aficiones"];
    echo "<td>Aficiones</td><td>";
    foreach($array as $valor){
        echo "$valor</br>";
    }  
    echo "</td>";
    $arrMenu=$_REQUEST["Menu"];

    echo "<tr><td>Menu</td><td>";
    foreach($arrMenu as $valor){
        echo "$valor</br>";
    }
    echo "</td></table>";
    ?>


</body>
</html>