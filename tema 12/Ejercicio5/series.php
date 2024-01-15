<?php

$_SESSION['Series']=['Pesadilla en la cocina','La que se avecina','Aida'];

echo "<ol>";
foreach($_SESSION['Series'] as $serie){
echo "<li>".$serie."</li>";
}
echo "</ol>";
echo "<a href=\"index.php?vista=home\">Volver</a>";
?>