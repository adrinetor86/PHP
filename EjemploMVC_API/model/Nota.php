<?php


class Nota
{

    private $table = 'notas';
    private $conection;

    public function __construct()
    {

        $this->conection = Db::conectarBD();
    }

    public function listar(): array{

        $numNotas = DEFAULT_NOTES;
        $sql = "SELECT * FROM " . $this->table;
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}