<?php 

    require_once 'config/config.php';
    require_once 'model/Db.php';
    require_once 'controller/ControladorLogin.php';
    require_once 'model/Handler.php';


   session_start();

   $capturador=new Handler();

  $propiedades= $capturador->getProperties();

    echo "CONTROLADOR: ".$propiedades['controller']."<br>";
    echo "accion: ".$propiedades['action']."<br>";
    echo "parámetros: ";
    print_r($propiedades['parametros']);echo"<br/>";

    if(!isset($_SESSION['login']) || $_SESSION['login']==false){

        $propiedades['controller']="ControladorLogin";
        $propiedades['action']="ComprobarUser";

//        $propiedades['controller']="ControladorLogin";
//        $propiedades['action']="ComprobarUser";

    }else{
       // echo "usuario: ".$_REQUEST['usuario']."<br>";
    }

    /* Si no está definido el controlador, cargo el controlador por defecto. */
    if($propiedades['controller']==null) {
        $propiedades['controller'] = constant("DEFAULT_CONTROLLER");
    }

    /* Si no está definida la acción, cargo la acción por defecto. */
    if($propiedades['action']==null) {
        $propiedades['action'] = constant("DEFAULT_ACTION");
    }

    $controller_path = 'controller/'.$propiedades['controller'] . '.php';
    echo "RUTA: ".$controller_path."<br>";
    /* Si no existe el fichero del controlador, indico que cargue el controlador por defecto. */
    if(!file_exists($controller_path)) {
      // $controller_path = 'controller/'.constant("DEFAULT_CONTROLLER").'.php';
        //$propiedades['controller'] = constant("DEFAULT_CONTROLLER");
    }

    /* Load controller */
    require_once $controller_path;
    $controllerName = $propiedades['controller'];
    $controller = new $controllerName();
echo "CONTROLADOR: ".$propiedades['controller']."<br>";
echo "accion: ".$propiedades['action']."<br>";
    /* Check if method is defined */
    $dataToView["data"] = [];

    if (method_exists($controller,$propiedades['action'])) {


       echo"ACTION<BR>"; print_r($propiedades['action']); echo"<BR>";
        $dataToView["data"] = $controller->{$propiedades['action']}();
        print_r($dataToView["data"]);
    } else {
        $dataToView["data"] = $controller->{constant("DEFAULT_ACTION")}();
    }

    /* Load views */
    require_once 'view/template/cabecera.php';
    require_once 'view/'.$controller->view.'.php';
    require_once 'view/template/pie.php';
