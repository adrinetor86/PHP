<?php


if(isset($arrDatos['datos']['libros'])) $libros=$arrDatos['datos']['libros'];
?>
<form action="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/buscar" method="post">
    <div id="busqueda">
    <!--RANGO ID-->

        <label>Minimo</label><input type="number" name="IdMin"><br>
        <label>Maximo</label><input type="number" name="IdMax"><br>

        <label>Titulo</label><input type="number" name="Titulo" ><br>
        <label>Genero</label><input type="number" name="Genero" ><br>
        <label>Pais</label><input type="number" name="Pais" ><br>

    </div>
</form>
    <a  href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/anadirLibro"><button>Insertar Libro</button></a>
<?php
  foreach ($libros as $libro){

      ?>
        <div class="div-libros">

            <?php echo"<p>TITULO: ".$libro['titulo']."</p>";?>
            <?php echo "<p> GENERO: ". $libro['genero']."</p>"?>
            <?php echo "<p> PAIS: </label>". $libro['pais']."</p>"?>
            <?php echo "<p>AÑO: </label>". $libro['ano']."</p>"?>
            <?php echo "<p> NUM PAGINAS: </label>". $libro['numPaginas']."</p>"?>


           <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/editarLibro/<?php echo $libro['idLibro']; ?>"> EDITAR</a></button>

           <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/borrarLibro/<?php echo $libro['idLibro']; ?>"> ELIMINAR</a></button>
        </div>
      <br>
<!--      echo $libro['titulo'];-->

<?php
  }