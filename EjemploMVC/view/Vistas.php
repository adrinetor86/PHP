<?php


class vista{


    static function cargarVista($dataToView){

        require_once 'view/template/cabecera.php';

        require_once 'view/' . $dataToView['vista'] . '.php';

        require_once 'view/template/pie.php';
    }

}



