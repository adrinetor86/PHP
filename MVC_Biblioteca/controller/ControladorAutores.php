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

    public function getView(){

        return $this->view;
    }
    public function getPageTitle(){

        return $this->page_title;
    }



}
