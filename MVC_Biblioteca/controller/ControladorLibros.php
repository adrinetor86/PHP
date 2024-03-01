<?php

    require_once ("modelo/autores.php");
    require_once ("modelo/libros.php");

   class ControladorLibros{
       public string $page_title;
       public string $view;
       private Libros $objlibro;
       private Autores $objAutores;

        public function __construct(){

            $this->page_title="Listar";
         $this-> view="listar";
         $this-> objlibro=new Libros();
         $this-> objAutores=new Autores();
        }

        public function getView(){

            return $this->view;
        }
        public function getPageTitle(){

            return $this->page_title;
        }

        public function listarLibros($params){

            $this->page_title="Listado Libros";
            $this-> view="listar";


              $intPagina=$params['page'] ?? 1;

                if($intPagina==""){
                    $intPagina=1;
                }

            $libros['paginasTotales']=$this->objlibro->siguientePagina($intPagina);

             $_GET['pagina']=$intPagina;
             $_GET['pagSiguiente']=$libros['paginasTotales'];

            $libros['libros']=$this->objlibro->mostrarLibros($intPagina);
            $libros['genero']=$this->objlibro->buscarColumna("GENERO");
            $libros['pais']=$this->objlibro->buscarColumna("PAIS");

            //HACER CAMBIO DE FUNCION
            $libros['autor']=$this->objlibro->buscarColumnaAutores();
            return $libros;
        }

        public function buscar(){


            $librosFiltrados['libroFiltrado']=$this->objlibro->buscarLibros($_POST);
            $librosFiltrados['genero']=$this->objlibro->buscarColumna("GENERO");
            $librosFiltrados['pais']=$this->objlibro->buscarColumna("PAIS");

            $librosFiltrados['autor']=$this->objlibro->buscarColumnaAutores();

          //  print_r($librosFiltrados['autor']);

            return $librosFiltrados;
        }

        //TENGO QUE IMPLEMENTAR LA TABLA AUTORES EN SAVE
       public function save(){

           $this->view = 'editarLibro';
           $this->page_title = 'Editar Libro';
           $_POST['edit'] = true;

         $libroEditado=  $this->objlibro->Confirmareditar($_POST);

         $libroEditado['autores'] =$this->objAutores->mostrarAutores();
          //print_r( $libroEditado);


        return $libroEditado;
       }
        public function editarLibro($params){

            $this->page_title="Editar Libro";
            $this-> view="editarLibro";
           // print_r($params);

                return $this->objlibro->edit($params);

        }
        public function anadirLibro(){
            $this->page_title="Añadir Libro";
            $this-> view="anadirLibro";
            $autores=new Autores();
            $arrReturn['autores']=$autores->mostrarAutores();
           return $arrReturn;

        }

        public function mostrarColumna($columna){

           $columnasDevueltas= $this->objlibro->buscarColumna($columna);

            return $columnasDevueltas;
        }

        public function confirmarAnadir(){

            $this->objlibro->insert($_POST);

            header("Location: http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/listarLibros");
        }
        public function borrarLibro($idLibro){

            print_r($idLibro);
            $this->page_title="Borrar Libro";
            $this->view="borrarLibro";

            //return $this->objlibro->delete($idLibro);
             return $this->objlibro->mostrarLibroId($idLibro);
        }

        public function confirmarBorrado(){

            $this->page_title="Borrar Libro";
            $this->view="borrarLibro";

            header("Location: http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/listarLibros");
            return $this->objlibro->confirmarDelete($_POST['id']);
        }

        public function anadirSaga(){

                $this->page_title="Añadir Saga";
                $this->view="anadirSaga";
            $this->objlibro->insertarSaga($_POST['Saga']);

        }




        public function ordenarSaga(){

                $this->page_title="Ordenados por Saga";
                $this-> view="ordenarSaga";


//            $this->objlibro->listarLibrosSagas();
//            $this->objlibro->listarSagas();
//             $sagas['sagas']=$this->objlibro->mostrarSagas();
          //  echo "####################<br><br>";

            return ['books' => $this->objlibro->listarLibrosSagas(),  'sagas' => $this->objlibro->listarSagas()];

        }


   }


