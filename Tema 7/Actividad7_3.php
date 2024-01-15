<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    function calcularPalabras(string $strFrase){
        $intLetras=0;
        $intEspacios=0;
        for($intCont=0;$intCont<strlen($strFrase);$intCont++){
            if(ctype_alpha($strFrase[$intCont])==true){
                $intLetras++;
            }else{
                $intEspacios++;
            }
        }
   
        echo "Letras= ".$intLetras."<br/>";
        echo "Palabras= ".$intEspacios+1;
        
    }
    $frase="Hola que tal";
    echo calcularPalabras($frase);
?>
    
</body>
</html>