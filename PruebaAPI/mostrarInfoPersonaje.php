<?php


$url = $_REQUEST['personaje'];

function sacarDatosApi($url)
{
    $objCurl = curl_init();
    curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($objCurl, CURLOPT_URL, $url);
    $objJSON = curl_exec($objCurl);
    $arrDatosJSON = json_decode($objJSON, true);

    if (curl_errno($objCurl)) {
        echo 'Error en la solicitud cURL: ' . curl_error($objCurl);
        return false;
    } else {
        return $arrDatosJSON;
    }
}




$arrInfoPersonaje = sacarDatosApi($url);

unset($arrInfoPersonaje['url']);

imprimirMultiplesAPIS($arrInfoPersonaje);



//HABRA QUE TOCAR CLAVES DEPENDENDO DE LA API QUE SE USE
function imprimirMultiplesAPIS($arrInfoPersonaje){

    echo "<table border='1px'>";
    foreach ($arrInfoPersonaje as $clave => $valor) {
        if (!empty($valor)) {

            if (is_array($valor)) {
                echo "<td>" . $clave . "</td>";
                echo "<td>";
                foreach ($valor as $valor2) {
                    $datosApi = sacarDatosApi($valor2);

                    if (array_key_exists('title', $datosApi)) {
                        echo $datosApi['title'] . "<br>";
                    } else {
                        echo $datosApi['name'] . "<br>";
                    }
                }
                echo "</tr>";

            } else {
                echo "<td>" . $clave . "</td>";
                if (comprobarURL($valor)) {
                    $valor = sacarDatosApi($valor);
                    echo "<td>" . $valor['name'] . "</td><tr>";
                } else {
                    echo "<td>" . $valor . "</td><tr>";
                }
            }
        } else {
            echo "<td>" . $clave . "</td>";
            echo "<td> No hay datos</td><tr>";
        }
    }
    echo "</table>";
}

function comprobarURL($strParametro){
    if (str_contains($strParametro, "https://")) {

       return true;

    } else {
        return null;
    }
}


