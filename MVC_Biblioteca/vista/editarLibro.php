<?php

if(isset($arrDatos['datos']['idLibro'])) $id = $arrDatos['datos']['idLibro'];
if(isset($arrDatos['datos']['titulo'])) $titulo = $arrDatos['datos']['titulo'];
if(isset($arrDatos['datos']['genero'])) $genero = $arrDatos['datos']['genero'];
if(isset($arrDatos['datos']['pais'])) $pais = $arrDatos['datos']['pais'];
if(isset($arrDatos['datos']['ano'])) $ano = $arrDatos['datos']['ano'];
if(isset($arrDatos['datos']['numPaginas'])) $paginas = $arrDatos['datos']['numPaginas'];

//echo "PRUEBA ID: ".$id;
//echo "PRUEBA TITULO: ".$titulo;
    ?>




    <form method="POST">
        <input type="hidden" name="idLibro" value="<?php echo $id; ?>" />
        <div>
            <label>Título</label>
            <input type="text" name="titulo" value="<?php echo $titulo; ?>" />

        </div>
        <div>
            <label>Genero</label>
            <textarea style="white-space: pre-wrap;" name="genero"><?php echo $genero; ?></textarea>
        </div>

        <div>
            <label>Pais</label>
            <input type="text" name="pais" value="<?php echo $pais; ?>" />

        </div>
        <div>
            <label>Año</label>
            <input type="text" name="ano" value="<?php echo $ano; ?>" />

        </div>
        <div>
            <label>Paginas</label>
            <input type="text" name="paginas" value="<?php echo $paginas; ?>" />

        </div>

        <input type="submit" value="Editar"
               formaction="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/save/<?php echo $id  ?>">



<!--        <a href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/--><?php //echo $_SESSION['numPagina']?><!--">Cancelar</a>-->
    </form>





<!--    --><?php //echo"<p>TITULO: ".$libro['titulo']."</p>";?>
<!--    --><?php //echo "<p> GENERO: ". $libro['genero']."</p>"?>
<!--    --><?php //echo "<p> PAIS: </label>". $libro['pais']."</p>"?>
<!--    --><?php //echo "<p>AÑO: </label>". $libro['ano']."</p>"?>
<!--    --><?php //echo "<p> NUM PAGINAS: </label>". $libro['numPaginas']."</p>"?>