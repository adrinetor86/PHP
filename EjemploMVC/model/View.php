<?php



  class View{

      public static function render(object $controlador,$arrData=null){

          include ('view/template/cabecera.php');
          include ('view/'.$controller->view.'.php');
          include ('view/template/pie.php');
      }

  }