<?php 

class Autor {

	private $table = 'autores';
	private $conection;

	public function __construct() {

        $this->conection = Db::conectarBD();
	}

	/* buscar libros */
	public function getAutores(): array{
        $sql = "SELECT distinct idPersona, concat(nombre,' ',apellido) FROM " . $this->table . ' order by 2';
        $stmt = $this->conection->prepare($sql);
		$stmt -> setFetchMode(PDO::FETCH_NUM);
		$stmt->execute();

		return $stmt->fetchAll();
	}

	/* buscar libros */
	public function getAutoresPorId(int $codLibro): array{
        $sql = "SELECT distinct a.idPersona, concat(nombre,' ',apellido) FROM " . $this->table . 
		' a, escriben e where a.idPersona=e.idPersona and e.idLibro='.$codLibro.' order by 2';
        $stmt = $this->conection->prepare($sql);
		$stmt -> setFetchMode(PDO::FETCH_NUM);
		$stmt->execute();

		return $stmt->fetchAll();
	}

}

?>