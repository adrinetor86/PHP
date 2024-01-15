

<?php
include_once ("./includes/cabecera.php");

    if(isset($_SESSION)){
        session_destroy();
    }
    session_start();

foreach ($_REQUEST as $clave =>$valor){
    $_SESSION[$clave]=$valor;
}


?>

<form action="pagina2.php">

    <input type="text" required  name="nombre" placeholder="Nombre"><br>
    <input type="text"  required name="apellido" placeholder="Apellido"><br>
    <input type="email" required name="email" placeholder="Email"><br>
    <input type="url" required name="url" placeholder="Url"><br>
    Genero: &nbsp;
    Mujer<input required type="radio" name="sexo" value="Femenino"> &nbsp;
    Hombre<input type="radio" require name="sexo" value="Masculino"></br>

    <input type="submit">

</form>

<?php

include_once ("./includes/pie.php");



