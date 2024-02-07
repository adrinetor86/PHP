<?php


function mostrarDatosUrl(object $objCurl,string $urlNueva) :string{
    curl_setopt($objCurl, CURLOPT_URL, $urlNueva);
    $objJSON = curl_exec($objCurl);
    $arrDatosJSON= json_decode($objJSON, true);
    //return $arrDatosJSON;
    return (strpos($urlNueva,'films')) ? $arrDatosJSON['title'] : $arrDatosJSON['name'];
}
$urlPerosnaje =$_REQUEST['personaje'];

$objCurl = curl_init();

curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);

// Establecer la URL a la que se realizará la solicitud del personaje 10

    curl_setopt($objCurl, CURLOPT_URL, $urlPerosnaje);
    // Configurar opciones para devolver el resultado como una cadena

    // Ejecutar la solicitud y obtener la respuesta
    $objJSON = curl_exec($objCurl);

    // Comprobar errores
    if (curl_errno($objCurl)) {
        echo 'Error en la solicitud cURL: ' . curl_error($objCurl);
    } else {
        // Decodificar la respuesta JSON
        $arrPersonajes = json_decode($objJSON, true);

            unset($arrPersonajes['url']);

        echo "<table border='1px'>";
        foreach ($arrPersonajes as $datos=>$valores){

         //
         //  print_r($datos);
            if(is_array($valores)){
                if(!empty($valores)) {


                    echo "<td>" . $datos . "<td>";
                    foreach ($valores as $valor) {
                        echo mostrarDatosUrl($objCurl, $valor) . "<br>";
                    }
                    echo "<tr>";
                }else{
                   echo "<td>No hay nada jai</td>";
                }
            }else{
                if(str_contains($valores,"swapi.dev/api/")){
                    echo "<td>".$datos."</td>";
                    echo  "<td>".mostrarDatosUrl($objCurl,$valores)."</td><tr>" ;
                }else{
                    echo "<td>".$datos."</td>";
                    echo "<td>".$valores."</td><tr>";
                }
            }
        }

        echo "</table>";
    }

    curl_close($objCurl);

