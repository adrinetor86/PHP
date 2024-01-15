
<?php
include_once ("./includes/cabecera.php");

session_start();

if(isset($_REQUEST)){

    foreach ($_REQUEST as $clave =>$valor){
        $_SESSION[$clave]=$valor;

        //echo $clave.' '.$valor;
        //  echo $_SESSION[$clave];
    }

}
?>
<form action="pagina3.php">


    <input type="number" name="convivientes" placeholder="Nº Convivientes"><br>

    AFICIONES<br>

    <input type="checkbox" name="aficiones[]" value="nadar">Nadar</br>
    <input type="checkbox" name="aficiones[]" value="furbo">Furbo</br>
    <input type="checkbox" name="aficiones[]" value="caza">Caza</br>
    <input type="checkbox" name="aficiones[]" value="gobernar">Gobernar</br>

    <!-- <input type="text" name="menu" placeholder="Menu"><br> --><br>
    MENU<br>
    <select name="menu[]">
        <option value="ARROZ A LA CUBANA">ARROZ A LA CUBANA</option>
        <option value="MERLUZA">MERLUZA</option>
        <option value="YATEKOMO">YATEKOMO</option>
    </select>
    <input type="submit">

</form>
<?php

include_once ("./includes/pie.php");