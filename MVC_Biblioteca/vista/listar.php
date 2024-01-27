<?php


if(isset($arrDatos['datos']['libros'])) $libros=$arrDatos['datos']['libros'];
if(isset($arrDatos['datos']['genero'])) $generos=$arrDatos['datos']['genero'];
if(isset($arrDatos['datos']['pais'])) $paises=$arrDatos['datos']['pais'];
if(isset ($arrDatos['datos']['libroFiltrado'])) $librosFiltrados=$arrDatos['datos']['libroFiltrado'];
    //print_r($generos);
    //print_r($arrDatos['datos']);

?>
<form action="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/buscar" method="post">
    <div id="busqueda">
    <!--RANGO ID-->
        <label>IDENTIFICADOR</label><br>
        <label>Minimo</label><input type="number" name="IdMin"><br>
        <label>Maximo</label><input type="number" name="IdMax"><br>

        <label>Titulo</label><input type="text" name="Titulo" ><br>

        <label>Genero</label><select  name="Genero">

            <option value="">Seleccione un Genero</option>
            <?php

                foreach ($generos as $genero) {

                    echo "<option value=\"".$genero['GENERO']."\">". $genero['GENERO']."</option>";
               }
            ?>

        </select>
        <br>
        <label>Pais</label><select  name="Pais">
            <option value="">Seleccione un Pais</option>
            <?php
            foreach ($paises as $pais) {

                echo "<option value=\"".$pais['PAIS']."\">". $pais['PAIS']."</option>";
            }
            ?>

        </select><br>

        <label>Año Minimo</label><input type="number" name="AnoMin"><br>
        <label>Año Maximo</label><input type="number" name="AnoMax"><br>
        <label>Numero Paginas</label><br>
        <label>Minimo</label><input type="number" name="MinPag" >
        <label>Maximo</label><input type="number" name="MaxPag" >

        <input type="submit" value="Buscar">
    </div>
</form>
    <a  href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/anadirLibro"><button>Insertar Libro</button></a>
<?php



//echo $arrDatos['datos']['libros'][0]['genero'];
//print_r($arrDatos);

//HE PUESTO LA CONDICION DEL ISSET PARA IMPRIMIR LA BUSQUEDA O TODOS LOS LIBROS

if(!isset ($arrDatos['datos']['libroFiltrado'])){

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

}else{

    foreach ($librosFiltrados as $libroFiltrado){

        ?>
        <div class="div-libros">

            <?php echo"<p>TITULO: ".$libroFiltrado['titulo']."</p>";?>
            <?php echo "<p> GENERO: ". $libroFiltrado['genero']."</p>"?>
            <?php echo "<p> PAIS: </label>". $libroFiltrado['pais']."</p>"?>
            <?php echo "<p>AÑO: </label>". $libroFiltrado['ano']."</p>"?>
            <?php echo "<p> NUM PAGINAS: </label>". $libroFiltrado['numPaginas']."</p>"?>


            <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/editarLibro/<?php echo $libroFiltrado['idLibro']; ?>"> EDITAR</a></button>

            <button> <a href="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/borrarLibro/<?php echo $libroFiltrado['idLibro']; ?>"> ELIMINAR</a></button>
        </div>
        <br>
        <!--      echo $libro['titulo'];-->

        <?php
    }

}
