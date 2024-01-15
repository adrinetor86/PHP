<?php

class Usuario{
    private $table = 'login';
    private $conection;

    public function __construct(){

        $this->conection= Db::conectarBD();
    }
    public function comprobarCredenciales($usuario,$pass): null | bool {
       // echo "hola beibi";

        $sql = "SELECT CONTRASEÑA FROM ".$this->table." where usuario ='" . $usuario . "' and contraseña='" . $pass. "'";

        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
       // $fila = $stmt->fetch();
        $intCantRegistros = $stmt -> rowCount();


        //PRUEBA
        if($intCantRegistros > 0) {
            echo "REGISTROS: ".$intCantRegistros."<br>";

            while ($fila = $stmt -> fetch()) {
                foreach ($fila as $key => $value) {
                    echo $key . ' ' . $value . '<br />';
                }
            }
         //   echo "Contraseña ".$fila['contraseña'];
        // return $fila['contraseña'];
            return true;
        }

        return false;
    }
}