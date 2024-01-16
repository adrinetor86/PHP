<?php 

    require_once 'model/Nota.php';

    class ControladorNota{
        public string $page_title;
        public string $view;
        private Nota $noteObj;

        public function __construct() {
            $this->view = 'listadoNotas';
            $this->page_title = 'Listado de notas';
            $this->noteObj = new Nota();
        }

        //hola
        // devuelve todas las notas
        public function list() : array{
            return $this->noteObj->getNotes();
        }

        // devuelve una nota concreta
        public function edit($id = null){
            $this->view = 'editarNota';
            /* Id can from get param or method param */
            if(isset($_GET["id"])) {
                $this->page_title = 'Editar nota';
                $id = $_GET["id"];
            } else {
                $this->page_title = 'Crear nota';

            }

            return $this->noteObj->getNoteById($id);
        }

        /* Create or update note */
        public function save(){
            $this->view = 'editarNota';

            if (isset($_REQUEST['id']) && $_REQUEST['id']!='') {
                $this->page_title = 'Editar nota';
                $_POST['edit'] = true;
            } else {
                $this->page_title = 'Crear nota';
                //echo $_REQUEST['titulo'];
                $_POST['edit'] = false;
            }

            $id = $this->noteObj->save($_POST);
            //echo $id;
            $result = $this->noteObj->getNoteById($id);

//            if($result['contenido']!='' && $result['contenido']!=''){
//
//
//            }
          //  echo $result['contenido'];
            $_GET["response"] = true;
            //echo "hola";
            return $result;
        }

        /* Confirm to delete */
        public function confirmDelete(){
            $this->page_title = 'Eliminar nota';
            $this->view = 'confirmaBorrarNota';
            return $this->noteObj->getNoteById($_GET["id"]);
        }

        /* Delete */
        public function delete(){
            $this->page_title = 'Listado de notas';
            $this->view = 'listadoNotas';
            return $this->noteObj->deleteNoteById($_POST["id"]);
        }

    }

?>