<?php 

    require_once 'config/config.php';
    require_once 'model/Db.php';
    require_once 'controller/ControladorLogin.php';
    require_once 'model/Handler.php';
    require_once 'model/View.php';

require_once 'view/Vistas.php';
   session_start();

   $capturador=new Handler();

  $propiedades= $capturador->getProperties();


    $controladorHandler=$propiedades['controller']??'';
    $accionHandler=$propiedades['action']??'';
    $parametrosHandler=$propiedades['parametros']??'';


    if(!isset($_SESSION['login']) || $_SESSION['login']==false){

        $controladorHandler="ControladorLogin";
        $accionHandler="ComprobarUser";

    }else{
       // echo "usuario: ".$_REQUEST['usuario']."<br>";
    }

    /* Si no está definido el controlador, cargo el controlador por defecto. */
    if(empty($controladorHandler)) {
        $controladorHandler = constant("DEFAULT_CONTROLLER");
    }

    //PRUEBA

    /* Si no está definida la acción, cargo la acción por defecto. */
    if(empty($accionHandler)) {
        $accionHandler = constant("DEFAULT_ACTION");
    }

    $controller_path = 'controller/'.$controladorHandler . '.php';
//    echo "RUTA: ".$controller_path."<br>";
    /* Si no existe el fichero del controlador, indico que cargue el controlador por defecto. */
    if(!file_exists($controller_path)) {
        $controller_path = 'controller/ControladorNota.php';
        $controladorHandler = "ControladorNota";
    }

    /* Load controller */
    require_once $controller_path;
    $controllerName = $controladorHandler;
    $controller = new $controllerName();

    /* Check if method is defined */
    $dataToView["data"] = [];

    if (method_exists($controller,$accionHandler)) {
        $dataToView["data"] = $controller->{$accionHandler}($parametrosHandler);
        $dataToView['vista']= $controller->view;
        $dataToView['page-title']= $controller->page_title;
    } else {
        $dataToView["data"] = $controller->listar();
        $dataToView['vista']= $controller->view;
        $dataToView['page-title']= $controller->page_title;
    }

    /* Load views */

    vista::cargarVista($dataToView);


