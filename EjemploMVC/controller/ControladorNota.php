<?php

    require_once 'model/nota.php';

    class ControladorNota{
        public string $page_title;
        public string $view;
        private Nota $noteObj;

        public function __construct() {
            $this->view = 'listadoNotas';
            $this->page_title = 'Listado de notas';
            $this->noteObj = new Nota();
        }

        // devuelve todas las notas
        public function list($params) : array{

            if(!empty($params['page'])) {


                $intPagina=$params['page'];
                $_GET['pagina']=$intPagina;
                $_SESSION['numPagina']=$intPagina;
                $_GET['siguiente'] = $this->noteObj->siguientePagina($intPagina);

                return $this->noteObj->getNotes(($intPagina-1)*DEFAULT_NOTES);


            }else{
                $params['page']=1;
            }

            return $this->noteObj->getNotes($params['page']);
        }

        public function listar(){


            $url="http://localhost/2DAW/PHP/EjemploMVC_API/index.php/notas";
            $objCurl = curl_init();
            curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($objCurl, CURLOPT_URL, $url);

            $objJSON = curl_exec($objCurl);

            $arrNotas = json_decode($objJSON,true);

            curl_close($objCurl);
       return $arrNotas;


        }





        // devuelve una nota concreta
        public function edit($params){

            $this->view = 'editarNota';
            /* Id can from get param or method param */
            if(!empty($params['id'])) {
                $this->page_title = 'Editar nota';
                $id = $params['id'];
            } else {
                $id=null;
                $this->page_title = 'Crear nota';

            }

            return $this->noteObj->getNoteById($id);
        }

        /* Create or update note */
        public function save(){

            $this->view = 'editarNota';
            $this->page_title = 'Editar nota';
            $_POST['edit'] = true;


            $id = $this->noteObj->save($_POST);

            $result = $this->noteObj->getNoteById($id);


            $_GET["response"] = true;

            return $result;
        }

        /* Confirm to delete */
        public function confirmDelete($params){
            $this->page_title = 'Eliminar nota';
            $this->view = 'confirmaBorrarNota';
            return $this->noteObj->getNoteById($params["id"]);
        }

        /* Delete */
        public function delete(){
            $this->page_title = 'Listado de notas';
            $this->view = 'listadoNotas';
            header('Location: http://localhost/2DAW/PHP/EjemploMVC/index.php/ControladorNota/list/'.$_SESSION['numPagina']);
            return $this->noteObj->deleteNoteById($_POST["id"]);
        }

    }

?>