<?php

    $titulo = "Ficheros Iguales";
   
    echo "<form method=\"get\" action=\"Actividad1.php\">";
        for($intCont=1; $intCont<3; $intCont++)
            echo "<input type=\"text\" name=\"ficheros[]\" placeholder=\"Fichero$intCont\"><br />";
        echo "<input type=\"submit\" value=\"Enviar\"><br />";    
    echo '</form>';

    $strFich1 = $_REQUEST["ficheros"][0];
    $strFich2 = $_REQUEST["ficheros"][1];
    
try{
    if(!is_file($strFich1)|| !is_file($strFich2))
    throw new Exception("No se puede abrir/No es un fichero.");

        $strContenidoFichero1 = file_get_contents($strFich1);
        $strContenidoFichero2 = file_get_contents($strFich2);
        $intTamanioFichero1 = filesize($strFich1);
        $intTamanioFichero2 = filesize($strFich2);

        if ($intTamanioFichero1 === $intTamanioFichero2 && $strContenidoFichero1 === $strContenidoFichero2)
        echo "TAMAÑO Y CONTENIDO IGUAL";
        else if ($intTamanioFichero1 === $intTamanioFichero2 && $strContenidoFichero1 !== $strContenidoFichero2) 
                echo "TAMAÑO IGUAL, CONTENIDO DIFERENTE";
            else 
                echo "TAMAÑO Y CONTENIDO DIFERENTE";
    
            }catch(Exception $e){

               echo "se produjo ESTO: ".$e->getMessage();
            }


            class ExcepcionFichero extends Exception{
                public function funcionExtends(){
                    echo "No existe algun fichero";
                }
            }

?>