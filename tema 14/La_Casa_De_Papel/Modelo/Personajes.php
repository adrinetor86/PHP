<?php

require_once("db.php");
require_once("Handler/handler.php");

class Personajes
{

    public $strTabla;
    public $connection;


    public function __construct()
    {

        $this->strTabla = "personajes";
        $this->conection = DB::conectarBD();
    }

    public function getValores($arrayParams){

        //  echo "hola"."<br>";
        $sql = "SELECT ".$this->strTabla.".* ,imagenes_personajes.imagen FROM 
                       ".$this->strTabla.",imagenes_personajes where
                       ".$this->strTabla.".imagenId = imagenes_personajes.id";


        if (count($arrayParams) > 0) {

            if (is_numeric($arrayParams[0])) {
                $sql .= " AND personajes.id=" . $arrayParams[0];

                //el nombre
            } else {

                if (str_contains($arrayParams[0], "%20")) {
                    $arrayParams[0] = str_replace("%20", " ", $arrayParams[0]);
                }
                $sql .= " AND personajes.nombre like'%" . $arrayParams[0] . "%'";
            }

        }
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();


        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function busquedaPorValores($arrayParams)
    {


        $sql = " WHERE nombre='" . $arrayParams[0] . "%%'";
        echo $sql;
        //echo $sql;
        return $sql;
    }


}

