<?php

    require_once "modelo/usuario.php";

    class ControladorLogin{

        public string $page_title;
        public string $view;
        private Usuario $objUsuario;



        public function __construct(){

            $this->page_title="Login";
            $this->view="login";
            $this->objUsuario=new Usuario();
        }


        public function verificarCredenciales($params){

            $this->view="login";

            $datosUsuario=[];

            $datosUsuario['usuario']= $_POST['usuario'] ?? '';
            $datosUsuario['contraseña']= $_POST['contraseña'] ?? '';

         $credenciales = $this->objUsuario->comprobarUsuario($_POST['usuario'],$_POST['contraseña']);

          //  echo "CREDENCIALES: ".$credenciales;
            if(!empty($datosUsuario['usuario']) || !empty($datosUsuario['contraseña'])) {

                    if ($credenciales == true) {

                        $_SESSION['login'] = true;

                 header('Location: http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/listarLibros/1');
                    } else {
                        $datosUsuario['error'] = 'login incorrecto';
                        //echo "<br>Debes introducir un usuario valido";
                    }

            }

         return $datosUsuario;
        }

        public function cerrarSesion(){

            unset($_SESSION['login']);
            session_destroy();
            session_start();
        }


    }