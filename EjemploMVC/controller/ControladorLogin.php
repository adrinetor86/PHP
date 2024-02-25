<?php

require_once 'model/Usuario.php';

class ControladorLogin{
    public string $page_title;
    public string $view;
    private Usuario $userObj;

    public function __construct() {
        $this->view = 'Login';
        $this->page_title = 'Login';
        $this->userObj = new Usuario();
    }


    public function ComprobarUser(){


        $datosUsuario= [];

        //$this->arrProperties['parametros']['page'] = $auxParametros[0] ?? '';

        $datosUsuario['usuario']= $_POST['usuario'] ?? '';
        $datosUsuario['contraseña']= $_POST['contraseña'] ?? '';


        if(!empty($datosUsuario['usuario']) || !empty($datosUsuario['contraseña'])){

            $passCorrecta= $this->userObj->comprobarCredenciales($_POST['usuario'],$_POST['contraseña']);

            if(isset($_POST['contraseña']) && $passCorrecta === true) {

                echo '<br>';

                $_SESSION['login'] = true;
                //echo $_SESSION['login'];
                header('Location: http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/listar');
            } else {

                $_SESSION['login'] = false;

                $datosUsuario['error'] = 'login incorrecto';
                echo "<br>DEBES METER UN USUARIO VALIDO <br>";
            }

            return $datosUsuario;

        }
        
    }

    public function cerrarSesion(){
        session_destroy();
        session_start();
    }
}

?>