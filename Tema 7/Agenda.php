<?php
include('cabecera.inc.php');

$agendaTelefonica=(isset($_REQUEST['NombreyNumeros']))?unserialize($_REQUEST['NombreyNumeros']):[];
$nombre=(isset($_REQUEST['strAgendaNombres']))?($_REQUEST['strAgendaNombres']):'';
$numero=(isset($_REQUEST['intAgendaNumeros']))?($_REQUEST['intAgendaNumeros']):'';



if($nombre==''){
echo"No se ha introducido el nombre del contacto";

}elseif(!key_exists($nombre,$agendaTelefonica)){//añadimos si no exite
    $agendaTelefonica[$nombre] = $numero;

}else{
    if(key_exists($_REQUEST['strAgendaNombres'],$agendaTelefonica)&&is_numeric($numero)){//cambiamos el telefono
        $agendaTelefonica[$nombre] = $numero;
        
    }
    elseif(key_exists($nombre,$agendaTelefonica)&&$numero==''){//borramos el contacto
    unset($agendaTelefonica[$nombre]);
}
}


function mostrarContactos(array $agendaTelefonica): void {
    echo "<h2>Contactos guardados</h2>";

    if (!empty($agendaTelefonica)) {
        echo "<table><thead><th>Contacto</th><th>Teléfono</th></thead>";
        echo "<tbody>";
        foreach($agendaTelefonica as $Nombre=>$Numero){//recorremos el array separandolo en nombre y numero
       
        echo "<tr><td>$Nombre</td><td>$Numero</td></tr>";
        }
        echo "</tbody></table>";
    }else{
        echo "<p>Sin Datos</p>";
         }
}
  
            echo "<section class=\"container\">";

            
            mostrarContactos($agendaTelefonica);
                echo"<form>";

                echo "<label>Nombre</label>";
                echo"<input type=\"text\" name=\"strAgendaNombres\" pattern=\"[A-Za-z]{1,15}\"><br>";
                echo "<label>Telefono</label>";
                echo "<input type=\"tel\" name=\"intAgendaNumeros\" pattern=\"[0-9]{9}\"><br>";

                echo "<input type=\"hidden\" name=\"NombreyNumeros\"value=".serialize($agendaTelefonica)."><br>";//guardamos cada valor enviado, con el serialize logramos almacenarlos
               
                 echo"<input type=\"submit\">";
                 echo "</form>";

                 echo "</section>";
echo "<audio src='epicSong.mp3'  controls autoplay=\"true\">";
                
?>
