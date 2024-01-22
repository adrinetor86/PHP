<?php


if(isset($arrDatos['datos']['libros'])) $libros=$arrDatos['datos']['libros'];


//echo "<p>TITULO: " . $libros['titulo'] . "</p>";

  foreach ($libros as $libro){

      ?>
        <div class="div-libros">

            <?php echo"<p>TITULO: ".$libro['titulo']."</p>";?>
            <?php echo "<p> GENERO: ". $libro['genero']."</p>"?>
            <?php echo "<p> PAIS: </label>". $libro['pais']."</p>"?>
            <?php echo "<p>AÑO: </label>". $libro['ano']."</p>"?>
            <?php echo "<p> NUM PAGINAS: </label>". $libro['numPaginas']."</p>"?>


           <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/editarLibro/<?php echo $libro['idLibro']; ?>"> EDITAR</a></button>

           <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/eliminarLibro/<?php echo $libro['idLibro']; ?>"> ELIMINAR</a></button>
        </div>
      <br>
<!--      echo $libro['titulo'];-->

<?php
  }