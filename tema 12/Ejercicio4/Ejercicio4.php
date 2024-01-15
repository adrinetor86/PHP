<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
session_destroy();
session_start();

foreach($_REQUEST as $key => $value) {
    $_SESSION[$key]= $value; 
    }
 ?> 

    <form action="pagina2.php">
 
    <input type="text" required  name="nombre" placeholder="Nombre"><br>
    <input type="text"  required name="apellido" placeholder="Apellido"><br>
    <input type="email" required name="email" placeholder="Email"><br>
    <input type="url" required name="url" placeholder="Url"><br>
    Genero: &nbsp; Mujer<input required type="radio" name="sexo" value="Femenino"> &nbsp; Hombre<input type="radio" require name="sexo" value="Masculino"></br>

    <input type="submit">

    </form>
</body>
</html>