
<?php

if(isset($arrDatos['datos']['idLibro'])) $id = $arrDatos['datos']['idLibro'] ;


if(isset($arrDatos['datos']['titulo'])){

    $titulo = $arrDatos["datos"]["titulo"];

   echo "<h3> Deseas Borrar el Libro: ". $titulo. " </h3>";
}
?>

<!--LE PASO A CONFIRMARBORRADO EL ID DEL LIBRO POR EL INPUT HIDDEN-->
<form action="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/confirmarBorrado/" method="POST">
    <input type="hidden" name="id" value=" <?php echo $id; ?>" />

    <input type="submit" value="Borrar">

    <input type="submit" value="Volver" formaction="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/listarLibros">


</form>