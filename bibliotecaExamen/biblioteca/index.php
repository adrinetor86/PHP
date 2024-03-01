<?php 

    require_once 'config/config.php';
    require_once 'model/Db.php';
    require_once 'model/Usuario.php';
    require_once 'handler/Handler.php';
    require_once 'view/View.php';

    session_start();

//echo "<a href=\"".constant('DEFAULT_ROOT')."/ControladorUsuario/logOut\">Salir</a>";
//echo Usuario::logado()?"Logado <br />":"fuera <br />";

    $objHandler = new Handler();
    $controller_path = 'controller/'. $objHandler->getControlador().'.php';
//echo "Controlador: ".$objHandler->getControlador()." acción: ".$objHandler->getAccion()."<br>";

    // si no existe el fichero del controlador, indico que cargue el controlador por defecto
    if(!file_exists($controller_path)) {
        $objHandler->setDefecto();
        $controller_path = 'controller/'. $objHandler->getControlador().'.php';
    }

    /* Load controller */
    require_once $controller_path; 
    $controllerName = $objHandler->getControlador();
    $controller = new $controllerName($objHandler->getParametros());

    // si no existe el método acción, que se cargue controlador y acción por defecto
    if(!method_exists($controller,$objHandler->getAccion())) {
        $objHandler->setDefecto();
        $controller_path = 'controller/'. $objHandler->getControlador().'.php';
        require_once $controller_path;
        $controllerName = $objHandler->getControlador();
        $controller = new $controllerName($objHandler->getParametros());
    }
	// se ejecuta el método del controlador y se cogen los datos devueltos
    $dataToView = $controller->{$objHandler->getAccion()}();
    // carga título
    $dataToView["varios"]['titulo'] =  $controller->page_title;
    $dataToView["varios"]['logado'] =  Usuario::logado();
//echo "Controlador: ".$objHandler->getControlador()." acción: ".$objHandler->getAccion()." vista:".$controller->view."<br>";
//print_r($dataToView);
    /* carga la vista */
    view::render($controller->view, $dataToView);
?>