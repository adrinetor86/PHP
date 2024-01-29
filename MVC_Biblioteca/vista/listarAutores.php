<?php


if(isset($arrDatos['datos']['autores'])) $autores=$arrDatos['datos']['autores'];



foreach ($autores as $autor) {
?>

            <?php echo"<p>NOMBRE: ".$autor['nombre']."</p>";?>
            <?php echo "<p> APELLIDO: ". $autor['apellido']."</p>"?>





            <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/editarLibro/<?php echo $autor['idPersona']; ?>"> EDITAR</a></button>

            <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/borrarLibro/<?php echo $autor['idPersona']; ?>"> ELIMINAR</a></button>


    <?php
}