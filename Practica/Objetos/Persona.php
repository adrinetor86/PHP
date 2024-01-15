<?php


 abstract class Persona {

    protected string $nombre;
    protected string $apellidos;

    public function __construct($nombre,$apellidos){

        $this->nombre=$nombre;
        $this->apellidos=$apellidos;

    }

    public static function toHtml(Persona $persona){

    }
    public function getNombre():string{

        return $this->nombre;
    }
    public function getApellidos():string{

        return $this->apellidos;
    }

    public function getNombreCompleto():string{

        return $this->nombre.' '.$this->apellidos;
    }

}