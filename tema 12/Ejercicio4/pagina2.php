<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
foreach($_REQUEST as $key => $value) {
$_SESSION[$key]= $value;

 
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

</body>
</html>