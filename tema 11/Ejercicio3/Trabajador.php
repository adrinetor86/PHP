<?php
include_once("Persona.php");

abstract class Trabajador extends Persona{

    private $telefonos=array();

  
    abstract public function calcularSueldo();

    ///public static function toHtml(Persona $objPersona){}

    public function aniadirTelefono(int $telefono):void {
    
        array_push($this->telefonos,$telefono);
  
    }

    

    public function listarTelefonos():string {
   
        return  implode(",",$this->telefonos);
    }

    public function vaciarTelefonos():void{
        $this->telefonos=[];
    }

 public function debePagarImpuestos():bool{

        
        if($this->calcularSueldo()>3333 && $this->edad>=18){
            echo "Debe pagar impuestos";
            return true;
        }else{
            echo " No tiene que pagar impuestos";
            return false;
        }

}
}  
?>