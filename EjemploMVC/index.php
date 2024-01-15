<?php 

    require_once 'config/config.php';
    require_once 'model/Db.php';
    require_once 'controller/ControladorLogin.php';
    require_once 'model/Handler.php';


   session_start();

   $capturador=new Handler();

  $propiedades= $capturador->getProperties();

    echo $propiedades['controller']."<br>";
    echo $propiedades['action']."<br>";
    echo print_r($propiedades['params']);

    if(!isset($_SESSION['login']) || $_SESSION['login']==false){

        $_GET["controller"]="ControladorLogin";
        $_GET["action"]="ComprobarUser";

    }else{
       // echo "usuario: ".$_REQUEST['usuario']."<br>";
    }

    /* Si no está definido el controlador, cargo el controlador por defecto. */
    if(!isset($_GET["controller"])) {
        $_GET["controller"] = constant("DEFAULT_CONTROLLER");
    }

    /* Si no está definida la acción, cargo la acción por defecto. */
    if(!isset($_GET["action"])) {
        $_GET["action"] = constant("DEFAULT_ACTION");
    }

    $controller_path = 'controller/'.$_GET["controller"] . '.php';
    echo "RUTA: ".$controller_path."<br>";
    /* Si no existe el fichero del controlador, indico que cargue el controlador por defecto. */
    if(!file_exists($controller_path)) {
       // $controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';
        //$_GET["controller"] = constant("DEFAULT_CONTROLLER");
    }

    /* Load controller */
    require_once $controller_path;
    $controllerName = $_GET["controller"];
    $controller = new $controllerName();

    /* Check if method is defined */
    $dataToView["data"] = [];

    if (method_exists($controller,$_GET["action"])) {
        $dataToView["data"] = $controller->{$_GET["action"]}();
    } else {
        $dataToView["data"] = $controller->{constant("DEFAULT_ACTION")}();
    }

    /* Load views */
    require_once 'view/template/cabecera.php';
    require_once 'view/'.$controller->view.'.php';
    require_once 'view/template/pie.php';
