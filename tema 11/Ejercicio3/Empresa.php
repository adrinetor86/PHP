<?php

include_once("Trabajador.php");

class Empresa {

    private string $nombreEmpresa;
    private string $direccion;
    protected array $trabajadores= array();



    public function getEmpresa(){
        return $this->nombreEmpresa;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function setEmpresa($nombre){
        $this->nombreEmpresa=$nombre;
    }   
    public function setDireccion($direccion){
        $this->direccion=$direccion;
    }   
    public function aniadirTrabajador(Trabajador $trabajador){
       array_push($this->trabajadores,$trabajador);
  
       //print_r($this->trabajadores);
        

    }

    public function listarTrabajadoresHtml(): string{
        // Trabajador::toHtml(Persona $p);
        echo "TRABAJADORES:  <br>";
        for($i=0;$i<count($this->trabajadores);$i++){
            echo($this->trabajadores[$i]->getNombreCompleto()." ".
                 $this->trabajadores[$i]->calcularSueldo()."€ [".
                 $this->trabajadores[$i]->listarTelefonos()." ]".
                 "<br>");
        }
        return "";
    } 
    public function getCosteNominas(): float{

        return 0.0;
    }

}

?>