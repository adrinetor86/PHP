<?php
include ("Empresa.php");
abstract class Persona{

public function __construct(
    protected ?string $strNombre,
    protected ?string $strApellido,
    protected ?int $edad,
    )

{}

public function getNombreCompleto():string{
      
     return $this->strNombre." ".$this->strApellido;
}  

public function getNombre():string{
      
    return $this->strNombre;
}  

public function getApellido():string{
      
    return $this->strApellido;
} 

// abstract public static function toHtml(Persona $objPersona);

// public function mostrarDatos(){
//     echo "Nombre: ".$this->strNombre.' Apellido '.$this->strApellido;
// }
}


?>