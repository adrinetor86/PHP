<?php

class Libro
{

    private $table = 'libros';
    private $conection;

    public function __construct()
    {

        $this->conection = Db::conectarBD();
    }

    /* buscar libros */
    public function getLibros(): ?array
    {
        $arrDev = []; // array para devolver los libros
        $objAutor = new Autor(); //

        if (isset($_REQUEST["minIdLibro"])) {
            $strWhere = $this->getWhere();
            $sql = "SELECT idLibro, titulo, genero, pais, ano, numPaginas FROM " . $this->table . $strWhere . ' order by idLibro';
//echo $sql;
            $stmt = $this->conection->prepare($sql);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();
            while ($arrLibro = $stmt->fetch()) {
                $arrPersonas = $objAutor->getAutoresPorId($arrLibro['idLibro']);
                $arrLibro['idPersona'] = []; // se cea el array con los id de las personas
                $arrLibro['nombreCompleto'] = ''; // se crea la cadena con los nombres de las personas
                foreach ($arrPersonas as $persona) { //por cada persona seleccionada se añade al libro
                    $arrLibro['idPersona'][] = $persona[0]; // se cea el array con los id de las personas
                    $arrLibro['nombreCompleto'] .= $persona[1] . '<br>';
                }

                //  print_r($arrLibro['idLibro']);
                $arrLibro['nota'] = $this->obtenerCalificacion($arrLibro['idLibro']);

                //print_r($arrLibro['nota']);
                if ($this->filtradoAutor($arrLibro['idPersona'])) // si se ha hecho filtrado por autor determinar si el autor está en el listado
                    $arrDev[] = $arrLibro;
            }
        }

        return $arrDev;
    }


    // monta el where con los parámetros pasados
    private function filtradoAutor(array $arrIdAutores): bool
    {
        $blnDevolver = true;
        // si no se filtra por autor todos valen
        if (isset($_REQUEST["autor"]) && count($_REQUEST["autor"]) != 0) {
            $blnDevolver = false; // por ahora no cumple con el filtro
//echo '<br>****autores llamada ';print_r($_REQUEST["autor"]);echo '<br>****autores libro ';print_r($arrIdAutores);echo '<br>';
            foreach ($arrIdAutores as $intAutor) // paso por todos los autores del libro
                if (in_array($intAutor, $_REQUEST["autor"])) { // si el autor está entre los del filtro
                    $blnDevolver = true;
                    break; // ya no busco más
                }
        }

        return $blnDevolver;
    }

    private function obtenerCalificacion($idLibro)
    {

        $sql = 'SELECT count(*) cantidad, avg(nota) media FROM comentarios where idLibro=' . $idLibro . '';

        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);


    }

    // monta el where con los parámetros pasados
    private function getWhere(): string
    {
        $strDevolver = '';

        // por cada uno de los valores que me han dado añado su condicción para formar el where
        // según el id
        if (isset($_REQUEST['minIdLibro']) && strlen(Libro::limpia($_REQUEST['minIdLibro'])) > 0)
            $strDevolver .= 'idLibro>=' . Libro::limpia($_REQUEST['minIdLibro']);
        if (isset($_REQUEST['maxIdLibro']) && strlen(Libro::limpia($_REQUEST['maxIdLibro'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . 'idLibro<=' . (Libro::limpia($_REQUEST['maxIdLibro']));

        // según el título
        if (isset($_REQUEST['titulo']) && strlen(Libro::limpia($_REQUEST['titulo'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . "titulo like '%" . (Libro::limpia($_REQUEST['titulo'])) . "%'";

        // según el género
        if (isset($_REQUEST['genero']) && strlen(Libro::limpia($_REQUEST['genero'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . "genero='" . (Libro::limpia($_REQUEST['genero'])) . "'";

        // según el pais
        if (isset($_REQUEST['pais']) && strlen(Libro::limpia($_REQUEST['pais'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . "pais='" . (Libro::limpia($_REQUEST['pais'])) . "'";

        // según el año
        if (isset($_REQUEST['minAnio']) && strlen(Libro::limpia($_REQUEST['minAnio'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . 'ano>=' . (Libro::limpia($_REQUEST['minAnio']));
        if (isset($_REQUEST['maxAnio']) && strlen(Libro::limpia($_REQUEST['maxAnio'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . 'ano<=' . (Libro::limpia($_REQUEST['maxAnio']));

        // según el num de páginas
        if (isset($_REQUEST['minPaginas']) && strlen(Libro::limpia($_REQUEST['minPaginas'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . 'numPaginas>=' . (Libro::limpia($_REQUEST['minPaginas']));
        if (isset($_REQUEST['maxPaginas']) && strlen(Libro::limpia($_REQUEST['maxPaginas'])) > 0)
            $strDevolver .= (strlen($strDevolver) > 0 ? ' and ' : '') . 'numPaginas<=' . (Libro::limpia($_REQUEST['maxPaginas']));

        // si se ha mandado algún valor añado el where
        if (strlen($strDevolver) > 0)
            $strDevolver = ' where ' . $strDevolver;

        return $strDevolver;
    }

    private static function limpia(string $strCadena): string
    {
        $arrValores = ['select', 'insert', 'delete', 'update', 'delete', 'from'];
        foreach ($arrValores as $strAux)
            $strCadena = str_ireplace($strAux, '', $strCadena);

        return $strCadena;
    }

    /* buscar libros */
    public function getDistintos(string $strAtributo): array
    {
        $sql = "SELECT distinct " . $strAtributo . " FROM " . $this->table . ' l';
        $sql .= $this->getWhere();
        $stmt = $this->conection->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}

?>