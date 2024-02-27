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
//print_r($arrInfoPersonaje);
unset($arrInfoPersonaje['url']);
foreach ($arrInfoPersonaje as $clave=>$valor) {

    echo $clave ." ";

    if(is_array($valor)){

        foreach ($valor as $valor2) {

            if(comprobarURL($valor2)){
                $valor2 = sacarDatosApi($valor2);
                echo $valor2['title']."<br>";
            }

        }

    }else{

        if(is_array($valor)) {
            foreach ($valor as $valor2) {
                echo $valor2 . "<br>";

            }

            if(comprobarURL($valor2)){
                $valor2 = sacarDatosApi($valor2);
                echo $valor2['name']."<br>";
            }
        }else{
            if(comprobarURL($valor)){
                $valor2 = sacarDatosApi($valor);
                echo $valor2['name']."<br>";
            }else{
                echo $valor . "<br>";
            }


        }

    }

}


function recogerNameoFilm(){

}

function comprobarURL($strParametro):string | null {
    if (str_contains($strParametro, "https://")) {

        return str_contains($strParametro, "films") ? "title" : "name";


    }else{
    return null;
    }
}


