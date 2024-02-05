<?php

if(isset($arrDatos['datos']['autores'])) $autores =$arrDatos['datos']['autores'];

?>

<form action="http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/confirmarAnadir" method="POST">

<input type="text" placeholder="Titulo" name="nuevoTitulo"><br>
<input type="text" placeholder="Genero" name="nuevoGenero"><br>
<input type="text" placeholder="Pais" name="nuevoPais"><br>
<input type="number" placeholder="Año" name="nuevoAno"><br>
<input type="number" placeholder="Paginas" name="nuevoPag"><br>

 <label>AUTOR</label>   <br>
<!--    Le pongo autores[] para que un libro pueda tener varios autores -->
    <select name="autores[]" multiple>

       <?php

       foreach ($autores as $autor){
           ?>

           <option value="<?php echo $autor['idPersona'] ?>"><?php echo $autor['nombre'].' '.$autor['apellido']  ?></option>

       <?php
       };
       ?>
    </select>

    <input type="submit" value="Insertar">
</form>