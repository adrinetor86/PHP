<?php

require_once ("db.php");
require_once ("Handler/handler.php");

    class Personajes{


        public $strTabla;
        public $connection;


        public function __construct(){

            $this->strTabla="personajes";
            $this->conection= DB::conectarBD();
        }

        public function getValores($arrayParams) {
            echo "hola"."<br>";
          $sql="SELECT * FROM ".$this->strTabla;


          if(count($arrayParams)>0){

              $sql.=" WHERE id=".$arrayParams[0];

              echo $sql;
          }
            $stmt = $this->conection->prepare($sql);
             $stmt->execute();

                return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    }
