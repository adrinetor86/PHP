<?php

    include("template/cabecera.php");


   if(isset($_POST['filtrado-id']) && trim($_POST['filtrado-id'])!=''){

<<<<<<< HEAD
=======
       echo $_POST['filtrado-id']."<br>";

            if(str_contains($_POST['filtrado-id']," ")){

                $_POST['filtrado-id']=str_replace(" ","%20", $_POST['filtrado-id']);
       }
>>>>>>> 9c85f29d694e10f3eb1765199c0fa99d56958bd2

       $url="http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes/".$_POST['filtrado-id'];


     //  $_POST['filtrado-id']
   }else{
       $url="http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes";
   }

  // $url=urlencode($url);

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

               echo "<table >";

               //bucle que imprime las cabeceras
               foreach ($arrPersonajes[0] as $personaje=> $valores2){
                   echo "<th> $personaje</th>";
                }

                    echo "<tr>";
               foreach ($arrPersonajes as $personaje  => $valores2) {

                   foreach ($valores2 as $valor){

                    echo"<td>". $valor." </td>";

                   }

                   echo "<tr>";
               }
               echo "</table>";
           }

      curl_close($objCurl);




