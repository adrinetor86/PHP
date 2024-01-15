<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
<?php

function cifrado(string $strCadena, int $intDesplazamiento){
    $intASCII=0;
    $strCadenaNueva="";
    for($intCont=0;$intCont<strlen($strCadena);$intCont++){
        if(ctype_alpha($strCadena[$intCont])==true){
        $intASCII=ord($strCadena[$intCont]);
        if(($intASCII+$intDesplazamiento)>122){
            $valorA=96;
            $intASCII=(122-$intASCII);
            $strCadenaNueva[$intCont]=chr(($valorA+$intDesplazamiento)-$intASCII);
        }else{
            $strCadenaNueva[$intCont]=chr($intASCII+$intDesplazamiento);
        } 
    }else{
        $strCadenaNueva[$intCont]=$strCadena[$intCont];
    }
   
    }
return $strCadenaNueva;
}

$cadena="az ,(b";
echo cifrado($cadena,2);
?>
</body>
</html>