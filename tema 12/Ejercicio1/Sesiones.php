<?php

$caducidad=time()+360;

session_start();
echo "Sesion: ". session_id()."<br>";

$_SESSION['sesionPrueba']=34;

echo $_SESSION['sesionPrueba'];
setcookie("idioma","ES",$caducidad);
setcookie("idiomas","PL",$caducidad);
echo "primero: ".$_COOKIE['idioma']."<br>";


setcookie("idioma","PL");
echo "segundo: ".$_COOKIE['idiomas']."<br>";

unset($_COOKIE['idiomas']);
echo "tercero: ".$_COOKIE['idiomas']."<br>";
?>