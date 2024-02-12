<?php


  // echo "buenas";

       $url="http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes";

    $objCurl = curl_init();
    curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);



           curl_setopt($objCurl, CURLOPT_URL, $url);

           // Configurar opciones para devolver el resultado como una cadena

           // Ejecutar la solicitud y obtener la respuesta
           $objJSON = curl_exec($objCurl);

           // Comprobar errores
           if (curl_errno($objCurl)) {
               echo 'Error en la solicitud cURL: ' . curl_error($objCurl);

           } else {

               $arrPersonajes = json_decode($objJSON,true);

               echo "<table border='1px'>";
               foreach ($arrPersonajes as $personaje  => $valores2) {


                   //el => $valores2 de abajo muestra las cabeceras
//                   foreach ($personaje as $valor => $valores2){
//
//                    echo $valor." ";
//                       echo $valores2."<br>";
//                   }

                   echo "<br>";
               }
               echo "</table>";
           }


      curl_close($objCurl);


        //return $arrDatosJSON;
        // return (strpos($url,'films')) ? $arrDatosJSON['title'] : $arrDatosJSON['name'];




