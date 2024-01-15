<?php
include ("../includes/PDO.inc.php");
session_start();
?>

<h1><?=$strTitulo?></h1>
<form>
    <select name="tipoGasolina">
        <option>gasoil</option>
        <option>gasolina 95</option>
        <option>gasolina 98</option>
        <option>gasoil agrícola</option>
    </select>
    <input type="number" placeholder="Litros Suministrados" name="litros">
    <input type="number" placeholder="importe" name="importe"><br>
    <input type="submit">
    <input type="submit" value="volver" name="volver">
</form>



