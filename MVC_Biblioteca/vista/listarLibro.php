<?php


if(isset($arrDatos['datos']['libro'])) $libro=$arrDatos['datos']['libro'];

    echo "<form method='POST'>";
    foreach ($libro as $datosLibro){
    ?>
        <input type="hidden" name="id" value=<?php echo $datosLibro['titulo'] ?>><br>
        <input type="text" name="titulo" value=<?php echo $datosLibro['titulo'] ?>><br>
        <input type="text" name="genero" value=<?php echo $datosLibro['genero'] ?>><br>
        <input type="text" name="pais" value=<?php echo $datosLibro['pais'] ?>><br>
        <input type="text" name="ano" value=<?php echo $datosLibro['ano'] ?>><br>
        <input type="text" name="paginas" value=<?php echo $datosLibro['numPaginas'] ?>>

        <input type="submit" value="Editar" formaction="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/editarLibro/<?php echo $datosLibro['idLibro']  ?> >

<?php

    }
echo "</form>";
