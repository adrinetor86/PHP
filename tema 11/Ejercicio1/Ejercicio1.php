<?php
include('Empleado.php');


$empleado1=new Empleado("ADRIAN","JACEK",1000);
echo $empleado1->getNombreCompleto()."<br>";
$empleado1->aniadirTelefono(123456789);
$empleado1->aniadirTelefono(555555555);
echo "TELEFONOS: (".$empleado1->listarTelefonos().")<br>";
echo $empleado1->debePagarImpuestos()."<br><br>";
//$empleado1->vaciarTelefonos();


$empleado2=new Empleado("ROBERTO","PEREZ",4000);
echo $empleado2->getNombreCompleto()."<br>";
$empleado2->aniadirTelefono(222222222);   
echo "TELEFONOS: (".$empleado2->listarTelefonos().")<br>";
echo $empleado2->debePagarImpuestos();


    

  
?>