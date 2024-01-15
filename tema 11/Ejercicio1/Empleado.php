<?php 

        //protected ?int $edad,

       // private array $telefonos,
        //private static $sueldoTope=0 
include("Persona.php");
class Empleado extends Persona{

    protected ?int $salario;
     protected $telefonos=array();
    public function __construct($strNombre,$strApellido,$salario=1000){ 

            parent::__construct($strNombre,$strApellido);
        $this->salario=$salario;
        }
        

    public function debePagarImpuestos():bool{
       
       echo "SALARIO ".$this->salario." ";
        
        // && $this->edad>=18
        if($this->salario>3333){
            echo " Debe pagar impuestos";
            return true;
        }else{
            echo " No tiene que pagar impuestos";
            return false;
        }
    }

    public function aniadirTelefono(int $telefono):void {
    
        array_push($this->telefonos,$telefono);
  
    }

    public function listarTelefonos():string {
   
        return  implode(",",$this->telefonos);
    }

    public function vaciarTelefonos():void{
        $this->telefonos=[];
    }
}

?>

