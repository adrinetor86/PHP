<?php


    require_once ("modelo/libros.php");
   class ControladorLibros{
       public string $page_title;
       public string $view;
       private Libros $objlibro;

        public function __construct(){

            $this->page_title="Listar";
         $this-> view="listar";
         $this-> objlibro=new Libros();

        }


        public function listarLibros($params){
            $this->page_title="Listado Libros";
            $this-> view="listar";
            $libros['libros']=$this->objlibro->mostrarLibros();

            return $libros;
        }

        public function listarLibro($params){

            $this->page_title="Listado Libros";
            $this-> view="listarLibro";
            $id = $params['id'];
            $libro['libro']= $this->objlibro->mostrarLibroId($id);

            return $libro;
        }
       public function save(){


           $this->view = 'editarLibro';
           $this->page_title = 'Editar Libro';
           $_POST['edit'] = true;


         $libroEditado=  $this->objlibro->Confirmareditar($_POST);


           print_r($libroEditado);
           //$_GET["response"] = true;

        return $libroEditado;
       }
        public function editarLibro($params){

            $this->page_title="Editar Libro";
            $this-> view="editarLibro";


                return $this->objlibro->edit($params);
        //header("Location:  http://localhost/2DAW/PHP/MVC_Biblioteca/index.php/ControladorLibros/listarLibros");
        }

   }