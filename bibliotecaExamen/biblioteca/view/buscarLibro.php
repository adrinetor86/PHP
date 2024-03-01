<form action="http://127.0.0.1/2daw/PHP/bibliotecaExamen/biblioteca/index.php/ControladorLibros/buscarLibro"
      method="POST">

    <?php


    if (isset($dataToView['data']) && empty($dataToView['data'])){


    ?>
    <fieldset>
        <legend>Valores de la Búsqueda</legend>
        <div>
            <label>Identificador Libro</label><br/>
            &nbsp;&nbsp;&nbsp;Mínimo: <input type="text" min="1" max="999" name="minIdLibro"
                                             value="<?php echo $_REQUEST["minIdLibro"] ?? ''; ?>"/><br/>
            &nbsp;&nbsp;&nbsp;Máximo: <input type="text" min="1" max="999" name="maxIdLibro"
                                             value="<?php echo $_REQUEST["maxIdLibro"] ?? ''; ?>"/><br/>
        </div>
        <div>
            <label>Título</label>
            <input type="text" name="titulo" value="<?php echo $_REQUEST["titulo"] ?? ''; ?>"/>
        </div>
        <div>
            <label for="genero">Genero</label>
            <select name="genero" id="genero">
                <option value=""></option>
                <?php
                foreach ($dataToView['genero'] as $genero) {
                    echo "<option value=\"" . $genero . "\"";
                    if (isset($_REQUEST["genero"]) && $genero == $_REQUEST["genero"])
                        echo "selected";
                    echo ">" . $genero . "</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="pais">Pais</label>
            <select name="pais" id="pais">
                <option value=""></option>
                <?php
                foreach ($dataToView['pais'] as $pais) {
                    echo "<option value=\"" . $pais . "\"";
                    if (isset($_REQUEST["pais"]) && $pais == $_REQUEST["pais"])
                        echo "selected";
                    echo ">" . $pais . "</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label>Año</label><br/>
            &nbsp;&nbsp;&nbsp;Mínimo: <input type="number" name="minAnio" min="1800" max="<?= getdate()['year']; ?>"
                                             value="<?php echo $_REQUEST["minAnio"] ?? ''; ?>"/><br/>
            &nbsp;&nbsp;&nbsp;Máximo: <input type="number" name="maxAnio" min="1800" max="<?= getdate()['year']; ?>"
                                             value="<?php echo $_REQUEST["maxAnio"] ?? ''; ?>"/><br/>
        </div>
        <div>
            <label>Número de páginas</label><br/>
            &nbsp;&nbsp;&nbsp;Mínimo: <input type="number" min="1" max="9999" name="minPaginas"
                                             value="<?php echo $_REQUEST["minPaginas"] ?? ''; ?>"/><br/>
            &nbsp;&nbsp;&nbsp;Máximo: <input type="number" min="1" max="9999" name="maxPaginas"
                                             value="<?php echo $_REQUEST["maxPaginas"] ?? ''; ?>"/><br/>
        </div>

        <div>
            <label for="autor">Autores</label>

            <select name="autor[]" multiple>
                <?php
                foreach ($dataToView['autor'] as $arrAutores) {
                    echo "<option value=\"" . $arrAutores[0] . "\"";
                    if (isset($_REQUEST["autor"]) && in_array($arrAutores[0], $_REQUEST["autor"]))
                        echo "selected";
                    echo ">" . $arrAutores[1] . "</option>";
                }
                ?>
            </select>
        </div>
    </fieldset>
    <!--            <a href="http://127.0.0.1/2daw/PHP/bibliotecaExamen/biblioteca/index.php/ControladorLibros/buscarLibro"></a>-->
    <input type="submit" value="Buscar"/>
</form>

<?php

// para que no muestre nada si no se ha realizado la búsqueda
} else {

    // print_r($dataToView['data']['nombreCompleto']);
    if (isset($_REQUEST["minIdLibro"])) {
        ?>

        <table border="1">
        <tr>
            <th>Id</th>
            <th>Título</th>
            <th>Género</th>
            <th>Pais</th>
            <th>Año</th>
            <th>Páginas</th>
            <th>Autor/es</th>
            <th>Valoracion</th>
        </tr>
        <?php
    }


    foreach ($dataToView['data'] as $arrLibro) {
        //print_r($dataToView['data']);
        echo "<tr>";
        foreach ($arrLibro as $strKey => $strValor)
            if ($strKey != "idPersona")
                if (is_array($strValor)) {

                    foreach ($strValor as $clave => $valor) {

                        if ($valor['media'] != 0) {
                            echo "\t<td>" . floor(($valor['media']) + 1) ;
                        } else {
                            echo "\t<td>" . floor(($valor['media'])) ;
                        }


                        $cantidadEstrellas = ceil($valor['media']) / 10;
                        $estrellasEnteras = $cantidadEstrellas / 2;

                        if ($cantidadEstrellas == 0) {

                            for ($j = 0; $j < 5; $j++) {
                                echo '<img src="http://127.0.0.1/2daw/PHP/bibliotecaExamen/estrellas/nada.png">';
                            }
                        } else {
                            for ($j = 0; $j < $estrellasEnteras; $j++) {
                                echo '<img src="http://127.0.0.1/2daw/PHP/bibliotecaExamen/estrellas/llena.png">';
                            }
                        }

                        echo "(" . $valor['cantidad'] . ")";
                    }
                    echo "</td>\n";


                } else {
                    echo "\t<td>" . $strValor . "</td>\n";
                }
        echo "</tr>\n";
    }
    ?>

    </table>
    <a href='http://127.0.0.1/2daw/PHP/bibliotecaExamen/biblioteca/index.php/'>BUSCAR LIBROS</a>
    <?php
}

?>
</div>