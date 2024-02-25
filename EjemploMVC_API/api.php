<?php

include_once 'config/config.php';
include_once "model/Db.php";
include_once 'model/Nota.php';


$objNota = new Nota();
//print_r($objNota->listar());

echo json_encode($objNota->listar());


