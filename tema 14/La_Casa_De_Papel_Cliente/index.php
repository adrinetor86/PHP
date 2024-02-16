<?php
    include("template/cabecera.php");

   if(isset($_POST['filtrado-id']) && trim($_POST['filtrado-id'])!=''){

            if(str_contains($_POST['filtrado-id']," ")){

                $_POST['filtrado-id']=str_replace(" ","%20", $_POST['filtrado-id']);
            }

       $url="http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes/".$_POST['filtrado-id'];

   }else{
       $url="http://localhost/2DAW/PHP/tema%2014/La_Casa_De_Papel/index.php/Personajes";
   }

        $arrPersonajes=recogerAPI($url);
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

            function recogerAPI($url){
                $objCurl = curl_init();
                curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);

                curl_setopt($objCurl, CURLOPT_URL, $url);

                $objJSON = curl_exec($objCurl);

                if (curl_errno($objCurl)) {
                    echo 'Error en la solicitud cURL: ' . curl_error($objCurl);

                }else{

                    $arrPersonajes = json_decode($objJSON,true);

                    curl_close($objCurl);
                    return $arrPersonajes;
                }
            }