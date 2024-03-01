<?php

class ControladorUsuario{
    public string $page_title;
    public string $view;
    private Usuario $objUsuario;

    public function __construct() {
        $this->objUsuario = new Usuario();
    }

    public function login(){
        $this->view = 'login';
        $this->page_title = 'Login';

        $arrDev["data"]["correo"] = $_REQUEST['correo']??'';
        $arrDev["data"]['password'] = $_REQUEST['password']??'';

        if(trim($arrDev["data"]['correo'])==='' || trim($arrDev["data"]['password'])==='')
            $arrDev["data"]['mensaje'] = 'Es obligatorio escribir correo y password para logarse';
        else if($this->objUsuario->loginOK($_REQUEST['correo'],$_REQUEST['password']))
                    header("Location:".constant('DEFAULT_ROOT'));
             else
                    $arrDev["data"]['mensaje'] = 'Correo o password incorrecto';
        
        return $arrDev;      
    }

    public function logOut(){
       unset($_SESSION['usuario']);
       session_destroy();
       session_start();
       $this->login();
    }
}