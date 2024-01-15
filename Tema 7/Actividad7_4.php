<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

$strFrase="buenos dias";

echo ucwords($strFrase)."<br/>";//Nos pondra Buenos Dias. Convierte la primera letra en mayuscula de cada palabra
echo strrev($strFrase)."</br>";//Nos pondra said soneub.Invierte
echo str_repeat($strFrase,2)."</br>";//Nos pondra buenos diasbuenos dias
echo md5($strFrase)."</br>";//Nos pondra una cadena codificada
?>

</body>
</html>