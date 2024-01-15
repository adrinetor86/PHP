<?php

include ("Empleado.php");



$empleado1= new Empleado("Adrian","Jacek",19,120,14);

$empleado1->meterTelefono(123456789);
$empleado1->meterTelefono(222222222);
echo $empleado1->getNombreCompleto();
 $empleado1->debePagarImpuestos();

 echo"[". $empleado1->listarTelefonos()."]";

echo $empleado1->calcularSueldo();

$empleado1->vaciarTelefonos();

echo"[". $empleado1->listarTelefonos()."]";