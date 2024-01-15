<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <?php
        session_start();
        
        echo "<body bgcolor=\"".$_SESSION['colorFondo']."\">";
    ?>
    <a href="Ejercicio3.php"> Volver</a>
</body>
</html>