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

          $sql="SELECT * FROM ".$this->strTabla;

              if (count($arrayParams) > 0) {

                      if(is_numeric($arrayParams[0])) {
                      $sql .= " WHERE id=" . $arrayParams[0];

                      //el nombre
                      }else{

                      if(str_contains($arrayParams[0],"%20")){

                          $arrayParams[0]= str_replace("%20"," ",$arrayParams[0]);
                    //   echo $arrayParams[0];
                          $sql .=" WHERE nombre like '%".$arrayParams[0]."%'";

                       //   echo $sql."<br>";
                      }else{
                          $sql .=" WHERE nombre like '%".$arrayParams[0]."%'";
                      }
                  }

              }
              $stmt = $this->conection->prepare($sql);
              $stmt->execute();

              return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }

