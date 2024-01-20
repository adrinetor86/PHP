
    <form action="http://localhost/2DAW/PHP/MVC_biblioteca/index.php/ControladorLogin/verificarCredenciales" method="post">

        <?php

        if(isset($arrDatos['datos']['usuario'])) $usuario=$arrDatos['datos']['usuario'];
        if(isset($arrDatos['datos']['contraseña'])) $contraseña=$arrDatos['datos']['contraseña'];


        ?>
            <br>

        <label>USUARIO</label>
        <input type="text" name="usuario">
                <br>
        <label>CONTRASEÑA</label>
        <input type="text" name="contraseña">

        <br>


        <input type="submit">


        <p><?php echo isset($arrDatos['data']['error']) ?? 'Introducir datos'?></p>
    </form>