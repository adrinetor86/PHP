
<!--<form action="index.php?controller=ControladorLogin&action=ComprobarUser" method="post">-->

    <form action="http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorLogin/ComprobarUser" method="post">

    <?php

    if(isset($dataToView["data"]["usuario"])) $usuario = $dataToView["data"]["usuario"];
    if(isset($dataToView["data"]["contraseña"])) $contraseña = $dataToView["data"]["contraseña"];


?>


<div>

    <label>Usuario</label>
    <input type="text" name="usuario">
        <br>
    <label>Contraseña</label>
    <input type="password" name="contraseña">

    <input type="submit">

    <p><?php echo isset($dataToView['data']['error']) ?? 'Introducir datos'?></p>
</div>


</form>


