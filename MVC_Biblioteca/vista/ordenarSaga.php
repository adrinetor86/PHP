<?php


if(isset($arrDatos['datos']['libros'])) $libros=$arrDatos['datos']['libros'];
if(isset($arrDatos['datos']['genero'])) $generos=$arrDatos['datos']['genero'];
if(isset($arrDatos['datos']['pais'])) $paises=$arrDatos['datos']['pais'];
if(isset($arrDatos['datos']['autor'])) $autores=$arrDatos['datos']['autor'];
if(isset ($arrDatos['datos']['libroFiltrado'])) $librosFiltrados=$arrDatos['datos']['libroFiltrado'];
if(isset ($arrDatos['datos']['sagas'])) $filtradoSaga=$arrDatos['datos']['sagas'];
if(isset ($arrDatos['datos']['librosSagas'])) $LibrosSaga=$arrDatos['datos']['librosSagas'];

print_r($arrDatos['datos']);
////print_r($filtradoSaga);
//print_r($arrDatos['datos']);
////
//foreach($arrDatos['datos'] as $datos) {
//
//   // echo "************<br><br>";
//
//    echo "<h2>" .$datos['nombreSaga']. "</h2> ";
//    print_r($datos);
//    foreach($datos as $datos2){
//      echo "************<br><br>";
//        print_r($datos2);
//
//
//        }




    $id = $arrDatos['datos']['sagas'][0]['idSaga'];
    $i = 0;

    echo '<h1>' . $arrDatos['datos']['sagas'][0]['nombreSaga'] . '</h1>';

    foreach ($arrDatos['datos']['books'] as $books){
        if($books['idSaga'] !== $arrDatos['datos']['sagas'][$i]['idSaga']) {
            $i++;
            echo '<h1>' . $arrDatos['datos']['sagas'][$i]['nombreSaga'] . '</h1>';
            $id = $arrDatos['datos']['sagas'][$i]['idSaga'];
        }
        echo $books['titulo']."<br>";
    }



//foreach ($arrDatos['datos'] as $datos){
//
//    echo "************<br><br>";
//
//    //   echo "<h2>" .$datos['nombreSaga']. "</h2> ";
////    foreach ($datos['librosSagas'] as $librosSagas){
////        echo $librosSagas['titulo'] ;
////    }
//}


//echo "<br><br><br><br><br><br><br><br><br>";
//echo $filtradoSaga[0]['nombreSaga'];
//echo "<br><br><br><br><br><br><br><br><br>";
//foreach ($filtradoSaga as $saga) {
//    echo "<h2>" . $saga['nombreSaga'] . "</h2> ";
//
//    foreach ($LibrosSaga as $libro) {
//        echo "<option value=\"" . $libro['idLibro'] . "\">" . $libro['titulo'] . "</option>";
//    }
//
//}






