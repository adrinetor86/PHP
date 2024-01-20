<?php

    require_once "Db.php";

    class Usuario{

        private $tabla = 'usuario';
        private $conection;


        public function __construct(){

            $this->tabla="usuario";
            $this->conection=DB::conectarBD();
        }


        public function comprobarUsuario($usuario,$pass){



            $sql= 'SELECT * FROM '. $this->tabla .' WHERE EMAIL = "'.$usuario. '" AND CONTRASENA = "'.$pass.'"';
           // echo $sql."<br>";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt -> rowCount();



            if($intCantRegistros > 0) {


                while ($fila = $stmt->fetch()) {
                    foreach ($fila as $key => $value) {
                        //    echo $key . ' ' . $value . '<br />';
                    }
                }
                return true;
            }else{

                echo "NO HAY NADIE";
                return false;
            }

        }

    }