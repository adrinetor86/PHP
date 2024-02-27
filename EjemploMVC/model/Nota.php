<?php 


class Nota {

	private $table = 'notas';
	private $conection;

    public function __construct(){

        $this->conection= Db::conectarBD();
    }


    public function siguientePagina(int $intPagina=0): bool{
        $sql = "SELECT count(*) as cantidad FROM " . $this->table;

        $stmt = $this->conection->prepare($sql);
        $stmt->execute();


        $cantidad=$stmt->fetch()["cantidad"];


        $_SESSION['maxPage']=ceil($cantidad/DEFAULT_NOTES);
      //  echo "MAX PAGE: ".$maxPage;
        // si tengo mas resistros que la pagina en la que estoy OK

        if ( $cantidad > $intPagina * DEFAULT_NOTES)
            return true;
         else
            return false;
    }




	/* Get all notes */
	public function getNotes($param):array{
        $numNotas=DEFAULT_NOTES;

		$sql = "SELECT * FROM ".$this->table . " limit $param,$numNotas";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll();

	}

	/* Get note by id */
	public function getNoteById($id){
		if(is_null($id)) return false;
		$sql = "SELECT * FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);

		return $stmt->fetchAll();


	}

	/* Save note */
	public function save($param){
    //Le he pasado un POST
      //echo "el param "; print_r($param);
		/* Set default values */
		$titulo = $contenido = "";

		/* Check if exists */
		$exists = false;
        //Comprueba si esta seteado el id y si no esta vacio
		if(isset($param["id"]) and $param["id"] !=''){
			$actualNote = $this->getNoteById($param["id"]);
            //En caso de que exista la nota con ese id
			if(isset($actualNote["id"])){
			$exists = true;
				/* Actual values */
				$id = $param["id"];
				$titulo = $actualNote["titulo"];

				$contenido = $actualNote["contenido"];
			}
		}

		/* datos recibidos */
		if(isset($param["titulo"])  and
           isset($param["contenido"]) ){

            $titulo = $param["titulo"];

            $contenido = $param["contenido"];
        }

		/* En caso de que ya existieran datos hara un update, en caso contrario un insert */
		if($exists){
			$sql = "UPDATE ".$this->table. " SET titulo=?, contenido=? WHERE id=?";
            echo $sql;
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$titulo, $contenido, $id]);
		}else{

            if($titulo!='' && $contenido!=''){
                $sql = "INSERT INTO ".$this->table. " (titulo, contenido) values('$titulo', '$contenido')";

                $stmt = $this->conection->prepare($sql);
                $stmt->execute();
                $id = $this->conection->lastInsertId();
                return $id;
            }


		}	

	}

	/* Delete note by id */
	public function deleteNoteById($id){
		$sql = "DELETE FROM ".$this->table. " WHERE id = ?";
		$stmt = $this->conection->prepare($sql);
		$stmt->execute([$id]);
        return $this->getNotes();
	}

}
