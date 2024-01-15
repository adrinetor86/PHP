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
        $datosUsuario['usuario']= $_POST['usuario'];
        $datosUsuario['contraseña']= $_POST['contraseña'];


        $passCorrecta= $this->userObj->comprobarCredenciales($_POST['usuario'],$_POST['contraseña']);

        echo 'LA PASS: '. $passCorrecta."<br>";
       echo  "No se q poner: ".$_POST['contraseña']."<br>";

        if(isset($_POST['contraseña']) && $passCorrecta === true) {

           echo '<br>';
            echo "Lego pelicula";
            $_SESSION['login'] = true;
            //echo $_SESSION['login'];
            header('Location: index.php');
        } else {
            echo "DEBES METER UN USUARIO VALIDO <BR>";
            $_SESSION['login'] = false;
            echo $_SESSION['login'];
            echo "PasCorect: ".$_POST['contraseña'];
            $datosUsuario['error'] = 'login incorrecto.';
        }

        return $datosUsuario;
    }


    public function cerrarSesion(){
        session_destroy();
        session_start();
    }
}

?>