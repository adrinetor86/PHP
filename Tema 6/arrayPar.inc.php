<?php

function esPar(int $num):bool{

    if($num%2==0){
        return true;
    }else
        return false;
}

function arrayAleatorio(int $tam, int $min, int $max):array{
    $array=[$tam];

    for($intCont=0;$intCont<count($array)-1;$intCont++){
      $array[$intCont]=Rand($min,$max);
    }
    return $array;
}


function arrayPares(array &$array): int{
    $intPares=0;

    for($intCont=0;$intCont<count($array)-1;$intCont++){
        if($array[$intCont]%2==0)
            $intPares++;     
    }
    return $intPares;
}
?>