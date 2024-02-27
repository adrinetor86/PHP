<?php
include_once "Functionality.php";



$arrFrases=["Hola","Adios","Buenos días","Buenas tardes","Buenas noches"];


                            //NOMBRE DEL FICHERO,        CONTENIDO
//Functionality::writeFileString('fichero.txt', 'Hola Mundo');
//Functionality::writeFileArr('fichero.txt', $arrFrases);

//Functionality::modifyFileLine("fichero.txt", 4, "Cambiado");
//Functionality::modifyreadFile("fichero.txt","Mi titulo nuevo");
//LEE EL FICHERO
Functionality::readFile("fichero.txt");


