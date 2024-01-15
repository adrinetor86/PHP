<?php
include_once("Empleado.php");

include_once("Empresa.php");
include_once("Gerente.php");
$empresa1=new Empresa();
$empleado1=new Empleado("Adrian","Jacek",19,120,14,123456789);
$empleado2=new Empleado("Ruben","Cuesta",19,110,17,222222222);

$gerente1=new Gerente("Adrian","Garcia",29,1500,111111111);
$empleado1->aniadirTelefono(2123232232);

 $empresa1->aniadirTrabajador($empleado1)."<br>";
 $empresa1->aniadirTrabajador($empleado2)."<br>";
 $empresa1->aniadirTrabajador($gerente1)."<br>";
 $empresa1->setEmpresa("SA");
 echo $empresa1->listarTrabajadoresHtml()."<br>";
 echo "Empresa: ". $empresa1->getEmpresa();

?>