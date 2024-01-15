<?php

function generador(){

$letra=chr(rand(65,90));

if(rand(0,1)==0){
    $letra=strtolower($letra);
}
    
return $letra;

} 
?>