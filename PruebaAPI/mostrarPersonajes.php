<?php
//include_once "../MVC_CHULETAS/Functionality.php";
//
////print_r($arrDatos);
//$consulta = 'https://swapi.dev/api/people/';
//do{
//
//    $arrDatos = Functionality::getJSON($consulta);
//    foreach ($arrDatos['results'] as $clave) {
//
//        echo $clave['url'] . " " . $clave['name'] . "<br>";
//        echo $arrDatos["next"];
//    }
//
//    $consulta =$arrDatos["next"];
//
//}while($consulta!= null);



$url="https://swapi.dev/api/people/";
function sacarDatosApi($url){
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

do{
    $arrDatos=sacarDatosApi($url);

    foreach ($arrDatos['results'] as $clave) {
        ?>

        <a href="http://localhost/2DAW/PHP/PruebaAPI/mostrarInfoPersonaje.php?personaje=<?=$clave['url'] ?>"><?=$clave['name']?></a><br>
        <?php
      //  echo "<a href='".$clave['url'].'"'>" ". $clave['name']. "<br></a>";
        $url= $arrDatos['next'];
    }
}while($url!==null)












//// Inicializar cURL
//$objCurl = curl_init();
//$consulta = 'https://swapi.dev/api/people/';
//curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);
//
//// Establecer la URL a la que se realizará la solicitud del personaje 10
//do {
//    curl_setopt($objCurl, CURLOPT_URL, $consulta);
//
//    // Configurar opciones para devolver el resultado como una cadena
//
//    // Ejecutar la solicitud y obtener la respuesta
//    $objJSON = curl_exec($objCurl);
//
//    // Comprobar errores
//    if (curl_errno($objCurl)) {
//        echo 'Error en la solicitud cURL: ' . curl_error($objCurl);
//    } else {
//        // Decodificar la respuesta JSON
//        $arrPersonajes = json_decode($objJSON, true);
//
//        // echo "MOLUSCOS";print_r($arrPersonajes);
//        foreach ($arrPersonajes["results"] as $personaje) {
//
//            ?>
<!--            <a href="infoPersonajes.php?personaje=--><?php //echo $personaje['url'] ?><!--"> --><?php //echo $personaje['name'] ?><!--</a><br>-->
<!--            --><?php
//        }
//        $consulta = $arrPersonajes["next"];
//    }
//} while ($consulta != null);
//// ... Puedes mostrar más información según la estructura de la respuesta JSON.
//// Cerrar la sesión cURL
//curl_close($objCurl);
