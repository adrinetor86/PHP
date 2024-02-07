<?php
// Inicializar cURL
$objCurl = curl_init();
$consulta = 'https://swapi.dev/api/people/';
curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);

// Establecer la URL a la que se realizará la solicitud del personaje 10
do {
    curl_setopt($objCurl, CURLOPT_URL, $consulta);

    // Configurar opciones para devolver el resultado como una cadena

    // Ejecutar la solicitud y obtener la respuesta
    $objJSON = curl_exec($objCurl);

    // Comprobar errores
    if (curl_errno($objCurl)) {
        echo 'Error en la solicitud cURL: ' . curl_error($objCurl);
    } else {
        // Decodificar la respuesta JSON
        $arrPersonajes = json_decode($objJSON, true);

       // echo "MOLUSCOS";print_r($arrPersonajes);
        foreach ($arrPersonajes["results"] as $personaje) {

            ?>
                <a href="infoPersonajes.php?personaje=<?php echo $personaje['url'] ?>"> <?php echo $personaje['name'] ?></a><br>
        <?php

            // Mostrar información sobre el personaje
//            echo 'Nombre: ' . $personaje['name'] . '<br>';
//            echo 'Altura: ' . $personaje['height'] . '<br>';
//            echo 'Peso: ' . $personaje['mass'] . '<br>';
//            echo 'Año de nacimiento: ' . $personaje['birth_year'] . '<br>';
        }
        $consulta = $arrPersonajes["next"];
    }
} while ($consulta != null);
// ... Puedes mostrar más información según la estructura de la respuesta JSON.
// Cerrar la sesión cURL
curl_close($objCurl);




