<?php

include("template/cabecera.php");


if (isset($_POST['filtrado-id']) && trim($_POST['filtrado-id']) != '') {

    //   echo $_POST['filtrado-id'] . "<br>";

    if (str_contains($_POST['filtrado-id'], " ")) {

        $_POST['filtrado-id'] = str_replace(" ", "%20", $_POST['filtrado-id']);
    }

    $url = "http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes/" . $_POST['filtrado-id'];

} else {
    $url = "http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes";
}


sacarDatosApi($url);
$arrPersonajes = sacarDatosApi($url);
if (sacarDatosApi($url) !== false && count($arrPersonajes) > 0) {


    echo "<table >";

    //bucle que imprime las cabeceras
    foreach ($arrPersonajes[0] as $personaje => $valores2) {

        if ($personaje !== "imagenId") {

            echo "<th> $personaje</th>";

        }

    }

    echo "<tr>";

    foreach ($arrPersonajes as $personaje => $valores2) {

        //el => $valores2 de abajo muestra las cabeceras
        foreach ($valores2 as $index => $valor) {

            if ($index !== 'imagenId') {

                if ($index === 'imagen') {
                    echo "<td><img src='" . $valor . "' width='200px' height='200px'></td>";

                } else {
                    echo "<td>" . $valor . " </td>";
                }

            }

        }

        echo "<tr>";
    }
    echo "</table>";

} else {
    echo "No se encuentran personajes";
}


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