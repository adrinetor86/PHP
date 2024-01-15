<form>
    <input type="number" placeholder="importe" name="importe"><br>
    <input type="text" placeholder="DNI" name="dni"><br>
    <input type="text" placeholder="matricula" name="matricula"><br>
    <input type="submit">
    <input type="submit" value="volver" name="volver">
</form>

<?php
session_start();
include_once ("../Repostajes/factura.php");