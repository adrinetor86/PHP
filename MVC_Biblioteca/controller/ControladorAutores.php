<?php

require_once ("modelo/autores.php");
class ControladorAutores{
    public string $page_title;
    public string $view;
    private Autores $objAutor;

    public function __construct(){

        $this->page_title="Lista Autores";
        $this-> view="listarAutores";
        $this-> objAutor=new Autores();

    }


    public function listarAutores(){

        $autores['autores']=$this->objAutor->listar();

        return $autores;

    }

    public function editarAutor(){

        $autores['autores']=$this->objAutor->listar();

        return $autores;

    }

    public function buscarAutores(){


        $autoresEncontrados['autoresEncontrados']=$this->objAutor->buscarLibros($_POST);
//            $librosFiltrados['genero']=$this->objAutor->buscarColumna("GENERO");
//            $librosFiltrados['pais']=$this->objAutor->buscarColumna("PAIS");
/*        echo "AUTORES: <BR>";
            print_r($autoresEncontrados['autoresEncontrados']);
        echo "<BR>";
*/            return $autoresEncontrados;
    }

    public function printAuthorsBooks(array $arrAuthorsBooks): void
    {
        foreach ($arrAuthorsBooks as $author) {
            echo '<h2>' . $author['NOMBRE'] . ' (ID: ' . $author['ID_PERSONA'] . ')</h2>';
            echo '<ul>';
            foreach ($author['LIBROS'] as $book) {
                echo '<li>' . $book['TITULO'] . '</li>';
            }
            echo '</ul>';
        }
    }




    public function getView(){

        return $this->view;
    }
    public function getPageTitle(){

        return $this->page_title;
    }



}
