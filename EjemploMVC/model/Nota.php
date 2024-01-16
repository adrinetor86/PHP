<?php 

class Nota {

	private $table = 'notas';
	private $conection;

    public function __construct(){

        $this->conection= Db::conectarBD();
    }


	/* Get all notes */
	public function getNotes(){
		$sql = "SELECT * FROM ".$this->table;
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

		return $stmt->fetch();
	}

	/* Save note */
	public function save($param){

		/* Set default values */
		$titulo = $contenido = "";

		/* Check if exists */
		$exists = false;
		if(isset($propiedades['parametros'][0]) && $propiedades['parametros'][0] !=''){
			$actualNote = $this->getNoteById($param["id"]);

            echo "ACTUALNOTE: ".$actualNote;
			if(isset($actualNote["id"])){
			$exists = true;
				/* Actual values */
				$id = $param["id"];
				$titulo = $actualNote["titulo"];
                //echo "Ya sabe ".$titulo;
				$contenido = $actualNote["contenido"];
			}
		}

		/* Received values */
		if(isset($param["titulo"])  and
           isset($param["contenido"]) ){

            $titulo = $param["titulo"];
        //    echo '$$$$$'.$titulo;
            $contenido = $param["contenido"];
        }

		/* Database operations */
		if($exists){
			$sql = "UPDATE ".$this->table. " SET titulo=?, contenido=? WHERE id=?";
			$stmt = $this->conection->prepare($sql);
			$res = $stmt->execute([$titulo, $contenido, $id]);
		}else{
           // echo "Prueba".$titulo.' contenido '.$contenido;

            if($titulo!='' && $contenido!=''){
                $sql = "INSERT INTO ".$this->table. " (titulo, contenido) values('$titulo', '$contenido')";
               // echo "????? $sql<br>";
                $stmt = $this->conection->prepare($sql);
                $stmt->execute();
                $id = $this->conection->lastInsertId();
                return $id;
            }

	    echo "no se pudo";
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
