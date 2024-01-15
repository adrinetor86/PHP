<?php

function digitos(int $num):int{

    return strlen($num);
}

function digitoN(int $num, int $pos):int{

    $numero=(string)$num;
    return $numero[$pos];
}

function quitarPorDetras(int $num, int $cant):int{
    $numero=(string)$num;
    $longitud=strlen($numero);
    if($cant>=0 && $cant<=$longitud){
        return substr($numero,0,$cant);
    }else
        return -1;
}

function quitarPorDelante(int $num, int $cant):int{
    $numero=(string)$num;
    $longitud=strlen($numero);
    if($cant>=0 && $cant<=$longitud){
        return substr($numero,$cant);
    }else
        return -1;
}



?>