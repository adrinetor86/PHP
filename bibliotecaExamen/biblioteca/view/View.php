<?php

// PLANTILLA DE LAS VISTAS

class View {
    public static function render($nombreVista, $dataToView = null) {
        include("view/template/cabecera.php");
//        include("view/template/nav.php");
        include("view/$nombreVista.php");
        include("view/template/pie.php");
    }
}