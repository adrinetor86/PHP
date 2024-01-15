<?php

include ("Persona.php");
abstract class Trabajador extends Persona{

    protected $telefonos = array();



    abstract function calcularSueldo();

    public function meterTelefono(int $numero)
    {

        array_push($this->telefonos, $numero);
    }

    public function debePagarImpuestos():bool{

        if($this->calcularSueldo()>3333 && $this->edad>=18){
            echo " Debe pagar impuestos";
            return true;
        }else{
            echo " No Debe pagar impuestos";
            return false;

        }
    }

    public function listarTelefonos(): string
    {

        return implode(",", $this->telefonos);
    }

    public function vaciarTelefonos(): void
    {

        $this->telefonos = [];
    }

}