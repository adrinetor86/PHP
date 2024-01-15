<?php

include("Empleado.php");

include("Gerente.php");
echo "EMPLEADO<br> ";
                    //Nombre Apellido Edad HorasT PrecioHora
$empleado1=new Empleado("Adrian","Jacek",19,1230,12,12344443);
echo $empleado1->getNombreCompleto()." ";
echo $empleado1->calcularSueldo()." €  ";
echo $empleado1->debePagarImpuestos();
 echo $empleado1->aniadirTelefono(22222222);
echo"[". $empleado1->listarTelefonos()."]<br><br>";

echo "GERENTE <br>";

$gerente1=new Gerente("Manuel","Lopez",23,1200,34333333);
echo $gerente1->getNombreCompleto()." ";
echo $gerente1->calcularSueldo()." €";
echo $gerente1->debePagarImpuestos();
echo $gerente1->aniadirTelefono(888888888);
echo"[". $gerente1->listarTelefonos()."]<br>";
?>