<?php


if(isset($arrDatos['datos']['autores'])) $autores=$arrDatos['datos']['autores'];

if(isset($arrDatos['datos']['autoresEncontrados'])) $autoresEncontrados=$arrDatos['datos']['autoresEncontrados'];
?>

    <form action="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorAutores/buscarAutores" method="post">
        <div id="buscar-autores">
        <label>ID Minimo</label><input type="number" name="IdMin"><br>
        <label>ID Maximo</label><input type="number" name="IdMax"><br>
        <label>Nombre</label><input type="text" name="Nombre"><br>
        <label>Apellido</label><input type="text" name="Apellido"><br>

     <input type="submit" value="Buscar">
        </div>
    </form>

<?php


    if(!isset($arrDatos['datos']['autoresEncontrados'])){


     foreach ($autores as $autor) {
      ?>
         <!--  div-autores-->
         <div class="div-autores">
                <?php echo"<p>NOMBRE: ".$autor['nombre']."</p>";?>
                <?php echo "<p> APELLIDO: ". $autor['apellido']."</p>"?>

                <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorAutores/editarAutor/<?php echo $autor['idPersona']; ?>"> EDITAR</a></button>

                <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorAutores/eliminarAutor/<?php echo $autor['idPersona']; ?>"> ELIMINAR</a></button>
         </div>
         <?php
     }

    }else{

        foreach ($autoresEncontrados as $autorEncontrado) {
                ?>
            <!--  div-autores-->
            <div class="div-autores">
                 <?php echo"<p>NOMBRE: ".$autorEncontrado['nombre']."</p>";?>
                <?php echo "<p> APELLIDO: ". $autorEncontrado['apellido']."</p>"?>

            <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorAutores/editarAutor/<?php echo $autorEncontrado['idPersona']; ?>"> EDITAR</a></button>

            <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorAutores/eliminarAutor/<?php echo $autorEncontrado['idPersona']; ?>"> ELIMINAR</a></button>
            </div>
            <?php
}
    }