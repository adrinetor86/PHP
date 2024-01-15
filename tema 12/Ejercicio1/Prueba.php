<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        body{
            background-color: <?php echo $_COOKIE["PruebaColor"]?>;
        }
    </style>
</head>
<body>
<?php

$numero=3;
$caducidad=time()+360;
$color="red";

setcookie("PruebaColor",$color);

if($numero==1){
    setcookie("PruebaColor","blue");
}elseif($numero==2){
    setcookie("PruebaColor",$color);
}else{
    setcookie("PruebaColor","orange");
}


setcookie("idioma","ES",$caducidad);
setcookie("idiomas","PL",$caducidad,"<body bgcolor='red'>");
echo "primero: ".$_COOKIE['idioma']."<br>";


setcookie("idioma","PL");
echo "segundo: ".$_COOKIE['idiomas']."<br>";

unset($_COOKIE['idiomas']);
echo "tercero: ".$_COOKIE['idiomas']."<br>";
?>
</body>
</html>