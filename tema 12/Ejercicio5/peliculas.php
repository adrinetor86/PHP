<?php


$_SESSION['Peliculas']=['Noche intensa','Pesadilla','Shrek'];
echo "<ol>";
foreach($_SESSION['Peliculas'] as $peliculas){
echo "<li>".$peliculas."</li>";
}
echo "</ol>";

echo "<a href=\"index.php?vista=home\">Volver</a>";
?>