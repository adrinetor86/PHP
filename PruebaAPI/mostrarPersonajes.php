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
}while($url!==null);


