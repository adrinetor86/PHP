<?php 


include_once("Trabajador.php");

class Empleado extends Trabajador{
    private int $horasTrabajadas;
    private int $precioPorHora;
  
 
    public function __construct($strNombre,$strApellido,$edad,$horasTrabajadas,$precioPorHora,$telefono){ 
        $this->horasTrabajadas=$horasTrabajadas;
        $this->precioPorHora=$precioPorHora;
        $this->aniadirTelefono($telefono);

           parent::__construct($strNombre,$strApellido,$edad,$telefono);
        }
        
        public function calcularSueldo(){
        return $this->horasTrabajadas*$this->precioPorHora;
        }


  
}

?>

