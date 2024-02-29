<?php

//require_once "controller/ControladorLibros.php";

    class Vista{


        public static function render($arrDatos){

      print_r($arrDatos["datos"]);

            include ("vista/template/cabecera.php");
            include("vista/template/nav.php");
            include ("vista/".$arrDatos["datos"]['vista'].".php");

        }

    }