<?php

include_once("Trabajador.php");
 class Gerente extends Trabajador{


    private int $salario;
    public function __construct($strNombre,$strApellido,$edad,$salario,$telefono){
        parent::__construct($strNombre,$strApellido,$edad);
        $this->salario=$salario;
        $this->aniadirTelefono($telefono);
    }
 
    public function calcularSueldo(){
       
        return $this->salario=$this->salario+($this->salario*$this->edad)/100;
    }


}
   
?>