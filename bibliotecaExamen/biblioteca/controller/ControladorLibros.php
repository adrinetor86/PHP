<?php

require_once 'model/Libro.php';
require_once 'model/Autor.php';

class ControladorLibros
{
    public string $page_title;
    public string $view;
    private Libro $objLibro;
    private array $arrParametros;

    public function __construct(array $arrParam)
    {
        $this->arrParametros = $arrParam;
        $this->objLibro = new Libro();
    }

    // busca coincidencias con un libro
    public function buscarLibro(): array
    {
        $this->view = 'buscarLibro';
        $this->page_title = 'Busqueda de Libros';

        $arrDev["data"] = $this->objLibro->getLibros();


        if (!empty($arrDev["data"])) {
            $this->page_title = 'Muestra Libros ';
        }

//echo "<br> Libros en controladorLibro ";print_r($arrDev["data"]);echo "<br>";
        $arrDev["pais"] = ControladorLibros::arrUnidimensional($this->objLibro->getDistintos('pais'));
        $arrDev["autor"] = (new Autor())->getAutores();


//echo "<br> en controladorLibro ";print_r($arrDev["pais"]);echo "<br>";
        return $arrDev;
    }


    // quita el array de cada elemento devolviendo el primero de cada subarray en un array unidimensional
    private static function arrUnidimensional(array $arrOrigen): array
    {
        $arrDev = [];

        foreach ($arrOrigen as $arrAux)
            $arrDev[] = $arrAux[0];

        return $arrDev;
    }

    public function mostrarLibros()
    {

        $this->view = 'buscarLibro';
        $this->page_title = 'Busqueda de Libros';


    }
}

?>