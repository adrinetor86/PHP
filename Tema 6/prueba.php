<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include('parametrosVariables.inc.php');
    include('matematicas.inc.php');
    
    echo concatenar('Hola','que','tal')."<br>";

    echo digitoN(345,2)."<br>";

    echo quitarPorDetras(345,3)."<br>";

    echo quitarPorDelante(345,2);
    ?>
    
</body>
</html>