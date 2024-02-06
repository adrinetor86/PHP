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



    public function mostrarAutores(){

        $sql= "SELECT * FROM ".$this->tabla ." ORDER BY NOMBRE";

        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


    //MUESTRA LOS AUTORES POR EL ID DE LIBRO




    public function mostrarAutoresPorId($id){

        $sql= "SELECT escriben.idPersona , concat(nombre,' ',apellido) as nombreCompleto
               FROM escriben,autores WHERE escriben.idPersona=autores.idPersona and escriben.idLibro=$id.";

        $stmt = $this->conection->prepare($sql);

        echo $sql;
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    //FUNCION PARA PILLAR EL VALOR MINIMO DE LA COLUMNA QUE LE PASAMOS
    private function getMinParam(string $nombreColumna){

        $sql = "SELECT MIN(".$nombreColumna.") AS MinColumna FROM " . $this->tabla ;
        //  echo "EL sql: ".$sql;
        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        $filaMin=$stmt->fetch(PDO::FETCH_ASSOC);
        return $filaMin['MinColumna'];
    }
    //FUNCION PARA PILLAR EL VALOR MAXIMO DE LA COLUMNA QUE LE PASAMOS
    private function getMaxParam(string $nombreColumna){
        $sql = "SELECT MAX(".$nombreColumna.") AS MaxColumna FROM " . $this->tabla ;
        //  echo "EL sql: ".$sql;
        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        $filaMax=$stmt->fetch(PDO::FETCH_ASSOC);
        return $filaMax['MaxColumna'];
    }

    public function buscarLibros($post){

        $post['IdMin'] = (!empty($post['IdMin'])) ? $post['IdMin'] : $this->getMinParam('idPersona');
        $post['IdMax'] = (!empty($post['IdMax'])) ? $post['IdMax'] : $this->getMaxParam('idPersona');
        $post['Nombre']= "%".$post['Nombre']."%";
        $post['Apellido']=  (!empty($post['Apellido'])) ? $post['Apellido'] : "%%";


        $sql = "SELECT *  FROM " . $this->tabla ." WHERE 
            idPersona BETWEEN ".$post['IdMin']." AND ".$post['IdMax'].
            " AND  NOMBRE LIKE '".$post['Nombre'].
            "' AND APELLIDO LIKE '".$post['Apellido']."'";

        //echo $sql;
        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }



}