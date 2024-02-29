<?php



    $parametros = [
        'titulo' => 'El Señor de los Anillos',
        'autor' => 'J.R.R. Tolkien',
        'genero' => 'Fantasía',
        'editorial' => 'Minotauro',
        'anio' => '1954'
    ];
    function buscarAvanzado($parametros) {
    // Iniciar la consulta SQL
    $sql = "SELECT * FROM libros JOIN escriben ON libros.idLibro = escriben.idLibro JOIN autores ON autores.idPersona = escriben.idPersona WHERE ";



    // Array para almacenar las condiciones de la consulta
    $condiciones = [];

    // Recorrer los parámetros de búsqueda
    foreach ($parametros as $campo => $valor) {
        // Si el valor no está vacío, agregar la condición a la consulta
        if (!empty($valor)) {

            if ($campo == 'titulo') {
                $condiciones[] = "libros.$campo LIKE $campo";

            } else if($campo == 'autor'){
                $condiciones[] = "libros.$campo LIKE $campo";

            } else if($campo == 'genero'){
                $condiciones[] = "libros.$campo LIKE $campo";

            } else if($campo == 'editorial'){
                $condiciones[] = "libros.$campo LIKE $campo";

            } else if($campo == 'anio'){
                $condiciones[] = "libros.$campo LIKE $campo";
            }

        }
    }

    // Unir las condiciones con 'AND'
    $sql .= implode(' AND ', $condiciones);

    // Preparar la consulta
    $stmt = $this->conection->prepare($sql);

    // Vincular los parámetros a la consulta
    $stmt->execute();


    // Ejecutar la consulta


    // Devolver los resultados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


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