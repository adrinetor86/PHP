
<?php

function mayor(...$num):int{
    $intMayor=0;

    foreach($num as $valor){
        if(is_numeric($valor) && $valor>$intMayor){
            $intMayor=$valor;
        }
    }
    return $intMayor;
}

function concatenar(...$palabras):string {
    
    return implode(' ',$palabras);
    
}
?>