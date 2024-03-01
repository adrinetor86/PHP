<?php

if(isset($arrDatos['datos']['idLibro'])) $id = $arrDatos['datos']['idLibro'];
if(isset($arrDatos['datos']['titulo'])) $titulo = $arrDatos['datos']['titulo'];
if(isset($arrDatos['datos']['genero'])) $genero = $arrDatos['datos']['genero'];
if(isset($arrDatos['datos']['pais'])) $pais = $arrDatos['datos']['pais'];
if(isset($arrDatos['datos']['ano'])) $ano = $arrDatos['datos']['ano'];
if(isset($arrDatos['datos']['numPaginas'])) $paginas = $arrDatos['datos']['numPaginas'];
if(isset($arrDatos['datos']['nombre'])) $nombre = $arrDatos['datos']['nombre'];
if(isset($arrDatos['datos']['apellido'])) $apellido = $arrDatos['datos']['apellido'];
if(isset($arrDatos['datos']['autores'])) $autores = $arrDatos['datos']['autores'];


if(isset($arrDatos['datos']['sagas'])) $Sagas = $arrDatos['datos']['sagas'];
//echo "PRUEBA TITULO: ".$titulo;
//print_r($arrDatos['datos'])
print_r($Sagas);
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
            <input type="text" name="numPaginas" value="<?php echo $paginas; ?>" />

            <label>Autor</label>
            <select name="Autor">

                <?php

                echo "<option value=\"".$arrDatos['datos']['idPersona'] ."\">". $nombre .' '. $apellido."</option>";

                foreach ($autores as $autor){

                echo "<option value=\"".$autor['idPersona'] ."\">". $autor['nombre'] .' '. $autor['apellido']."</option>";

                }

                ?>
            </select>

            <select name="Saga">
                <?php


                foreach ($Sagas as $saga){
                   ?>

                    <option value="<?php echo $saga['idSaga']?>"><?php echo $saga['nombreSaga']?></option>
                <?php
                };
                ?>
            </select>

<!--            <input type="text" name="Autor" value="--><?php //echo $titulo; ?><!--" />-->
<!--            <br /><b>Warning</b>:  Undefined variable $paginas in <b>C:\xampp\htdocs\2DAW\PHP\MVC_Biblioteca\vista\editarLibro.php</b> on line <b>41</b><br />-->
        </div>

        <input type="submit" value="Editar" formaction="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/save/<?php echo $id ?>">
        <input type="submit" value="Volver" formaction="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/listarLibros ">


<!--        <a href="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/--><?php //echo $_SESSION['numPagina']?><!--">Cancelar</a>-->
    </form>
