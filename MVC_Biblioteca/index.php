<?php

        require_once "controller/ControladorLogin.php";
        require_once "handler/handler.php";
        require_once "vista/Vista.php";
        require_once "config/config.php";

        session_start();


    $capturador=new Handler();

    $propiedades=$capturador->getProperties();

    $controladorHandler=$propiedades['controller'] ?? '' ;
    $accionHandler=$propiedades['action'] ?? '';
    $parametrosHandler=$propiedades['parametros'] ?? '';

//    echo "Controlador ". $propiedades['controller']."<br>";
//    echo "Accion ".$propiedades['action']."<br>";
//    echo "Parametros ".print_r($propiedades['parametros']);


//    $params=[];
//    $params['usuario']="adrinetor81@gmail.com";
//    $params['pass']="contraseña";

    if(!isset($_SESSION['login']) || $_SESSION['login']==false){

        $controladorHandler='ControladorLogin';
        $accionHandler='verificarCredenciales';

        }else{

    }


    if(empty($controladorHandler)) {
        $controladorHandler = constant("DEFAULT_CONTROLLER");
    }

    //PRUEBA

    /* Si no está definida la acción, cargo la acción por defecto. */
    if(empty($accionHandler)) {
        $accionHandler = constant("DEFAULT_ACTION");
    }

    $controller_path = 'controller/'.$controladorHandler . '.php';

    /* Si no existe el fichero del controlador, indico que cargue el controlador por defecto. */

    if(!file_exists($controller_path)) {
        $controller_path = 'controller/ControladorLibros.php';
        $controladorHandler = "ControladorLibros";
    }

    /* Load controller */
    require_once $controller_path;
    $controllerName = $controladorHandler;
    $controladorObj = new $controllerName();


    if(method_exists($controladorObj,$accionHandler)){

        $arrDatos['datos']= $controladorObj->{$accionHandler}($parametrosHandler);

        $arrDatos["datos"]['vista']= $controladorObj->getView();
        $arrDatos["datos"]['pageTitle']= $controladorObj->getPageTitle();
    }else{
        echo "NO EXISTE ESE METODO";
        $arrDatos["datos"]['vista']= $controladorObj->getView;
        $arrDatos["datos"]['pageTitle']= $controladorObj->getPageTitle;
        $arrDatos["datos"] = $controladorObj->listarLibros($parametrosHandler);
    }

    include ("vista/template/cabecera.php");
    include("vista/template/nav.php");

//    echo "VISTA: ".$controladorObj->view;
   //require_once("vista/".$controladorObj->view.".php");
    //print_r($arrDatos);

   Vista::render($arrDatos);




