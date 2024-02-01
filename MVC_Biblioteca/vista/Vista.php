<?php

//require_once "controller/ControladorLibros.php";

    class Vista{


        public static function render($arrDatos){

//            print_r( $arrDatos['datos']['vista']);echo "<br>";
//            print_r( $arrDatos['datos']['pageTitle']);
//            print_r($arrDatos['datos']['libros']);

            include ("vista/".$arrDatos['datos']['vista'].".php");

        }

    }