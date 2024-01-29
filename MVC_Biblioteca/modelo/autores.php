<?php


require_once ("Db.php");

class Autores{

    private $tabla = 'autores';

    private $conection;


    public function __construct(){

        $this->tabla = "autores";
        $this->conection = DB::conectarBD();
    }


    public function listar(){

        $sql= "SELECT * FROM ".$this->tabla;

        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        // $fila = $stmt->fetch();
        //$intCantRegistros = $stmt->rowCount();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



}