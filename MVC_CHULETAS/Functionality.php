<?php
abstract class Functionality
{
    public static function getJSON($url): array|null
    {
        $objCurl = curl_init();
        $arrReturn = null;

        curl_setopt($objCurl, CURLOPT_URL, $url);
        curl_setopt($objCurl, CURLOPT_RETURNTRANSFER, 1);

        $strJSON = curl_exec($objCurl);

        if (curl_errno($objCurl)) {
            echo 'Error';
        } else {
            $httpCode = curl_getinfo($objCurl, CURLINFO_HTTP_CODE);

            if ($httpCode === 200) {
                $arrReturn = json_decode($strJSON, true);
            }
        }
        curl_close($objCurl);

        return $arrReturn;
    }

    protected function paginateData(int $intTotalRegisters, string $strSelectedPage): array
    {
        $arrReturn = [];

        $intSelectedPage = (int)$strSelectedPage;

        if (isset($_POST['numRegisters'])) {
            $_SESSION['numRegisters'] = $_POST['numRegisters'];
        }

        $numberRegisters = $_SESSION['numRegisters'] ?? DEFAULT_REGISTERS;

        $arrReturn['totalRegisters'] = $intTotalRegisters;

        $maxPage = ceil($intTotalRegisters / $numberRegisters);
        $arrReturn['maxPage'] = $maxPage;

        if ($intSelectedPage <= 1) {
            $intSelectedPage = 1;
        } elseif ($intSelectedPage > $maxPage) {
            $intSelectedPage = $maxPage;
        }

        $arrReturn['selectedPage'] = $intSelectedPage;

        return $arrReturn;
    }

    public static function printPages(int $count, string $strElement): void
    {
        $selectedPage = $_SESSION['actualPage'];
        $maxPage = ceil($count / DEFAULT_REGISTERS);

        $_SESSION['maxPage'] = $maxPage;

        $URL = CONTROLLERs_URL[$strElement] . 'list/';
        $URLPreviousPage = $URL . ($selectedPage - 1);
        $URLNextPage = $URL . ($selectedPage + 1);

        echo '<article>';

        echo '<a href="' . $URLPreviousPage . '"><button ' . ($selectedPage <= 1 ? 'disabled' : '')
            . '>Anterior</button></a>';

        for ($intCont = 1; $intCont <= $maxPage; $intCont++) {
            $URLPage = $URL . $intCont;
            echo '<a ' . ($intCont !== (int)$selectedPage ? 'href="' . $URLPage . '"' : 'class="selected"')
                . '>' . $intCont . '</a>';
        }

        echo '<a href="' . $URLNextPage . '"><button ' . ($selectedPage >= $maxPage ? 'disabled' : '')
            . '>Siguiente</button></a>';

        echo '</article>';
    }

    public static function printFilterOptions(string $strElement): void
    {
        $arrOptions = DEFAULT_OPTIONS;
        $URL = CONTROLLERs_URL[$strElement] . 'list/';
        $blnSelected = false;

        echo '<article>';
        echo '<form method="post" action="' . $URL . '">';
        echo '<article><label for="numRegisters">Cantidad de registros por página</label></article>';
        echo '<article>';
        echo '<select name="numRegisters" id="numRegisters">';
        foreach ($arrOptions as $option) {
            echo '<option value="' . $option . '"';

            if ((!$blnSelected) and (($option === DEFAULT_REGISTERS) or ($option === $_SESSION['numRegisters']))) {
                $blnSelected = !$blnSelected;
                echo 'selected';
            }

            echo '>' . $option . '</option>';
        }
        echo '</select>';
        echo '</article>';
        echo '<article><button type="submit">Filtrar</button></article>';
        echo '</article>';
        echo '</form>';
        echo '</article>';
    }

    public static function printInfo(array $arrParams, string $strElement): void
    {
        $numRegisters = $_SESSION['numRegisters'] ?? DEFAULT_REGISTERS;
        $selectedPage = $arrParams['selectedPage'];
        $maxPage = $arrParams['maxPage'];
        $totalRegisters = $arrParams['totalRegisters'];
        $firstResult = ($selectedPage - 1) * $numRegisters + 1;
        $lastResult = ($selectedPage < $maxPage)
            ? ($selectedPage * $numRegisters)
            : $totalRegisters;

        echo '<article>';
        echo '<p>Mostrando ' . $numRegisters . ' ' . $strElement . ' por página';
        echo '<p>Resultados ' . $firstResult . ' - ' . $lastResult . ' de ' . $totalRegisters . ' ' . $strElement;
        echo '</article>';
    }

    public static function printItems(array $arrData, string $strElement): void
    {
        $URL = CONTROLLERs_URL[$strElement];

        switch ($strElement) {
            case 'books':
                foreach ($arrData as $book) {
                    $URLToEdit = $URL . 'edit/' . $book['ID_LIBRO'];
                    $URLToDelete = $URL . 'confirmDelete/' . $book['ID_LIBRO'];

                    echo '<section class="element">';
                    echo '<h2>' . mb_strtoupper($book['TITULO'], 'UTF-8') . '</h2>';
                    echo '<table>';
                    echo '<tbody>';
                    echo '<tr><th>ID LIBRO</th><td>' . $book['ID_LIBRO'] . '</td></tr>';
                    echo '<tr><th>GÉNERO PRINCIPAL</th><td>' . mb_strtoupper($book['GENERO'], 'UTF-8') . '</td></tr>';
                    echo '<tr><th>PAÍS</th><td>' . mb_strtoupper($book['PAIS'], 'UTF-8') . '</td></tr>';
                    echo '<tr><th>AÑO DE PUBLICACIÓN</th><td>' . $book['ANO'] . '</td></tr>';
                    echo '<tr><th>NÚMERO DE PÁGINAS</th><td>' . $book['NUM_PAGINAS'] . '</td></tr>';
                    echo '</tbody>';
                    echo '</table>';
                    if ($_SESSION['userRole'] > 5) {
                        echo '<article class="btn-container">';
                        echo '<a class="edit-element" href="' . $URLToEdit . '">Editar</a>';
                        echo '<a class="delete-element" href="' . $URLToDelete . '">Borrar</a>';
                        echo '</article>';
                    }
                    echo '</section>';
                }
                break;
            case 'authors':
                foreach ($arrData as $author) {
                    $URLToEdit = $URL . 'edit/' . $author['ID_PERSONA'];
                    $URLToDelete = $URL . 'confirmDelete/' . $author['ID_PERSONA'];
                    $authorCompleteName = $author['APELLIDO'] . ', ' . $author['NOMBRE'];

                    echo '<section class="element">';
                    echo '<h2>' . mb_strtoupper($authorCompleteName, 'UTF-8') . '</h2>';
                    echo '<table>';
                    echo '<tbody>';
                    echo '<tr><th>ID AUTOR</th><td>' . $author['ID_PERSONA'] . '</td></tr>';
                    echo '<tr><th>FECHA DE NACIMIENTO</th><td>' . $author['FECHA_NACIMIENTO'] . '</td></tr>';
                    echo '<tr><th>PAÍS</th><td>' . mb_strtoupper($author['PAIS_ORIGEN'], 'UTF-8') . '</td></tr>';
                    echo '<tr><th>CANTIDAD DE LIBROS PUBLICADOS</th><td>' . $author['LIBROS_PUBLICADOS'] . '</td></tr>';
                    echo '</tbody>';
                    echo '</table>';
                    if ($_SESSION['userRole'] > 5) {
                        echo '<article class="btn-container">';
                        echo '<a class="edit-element" href="' . $URLToEdit . '">Editar</a>';
                        echo '<a class="delete-element" href="' . $URLToDelete . '">Borrar</a>';
                        echo '</article>';
                    }
                    echo '</section>';
                }
                break;
        }
    }

    public static function readFile(string $strFile): void
    {
        /**
         * Opciones de apertura de un fichero:
         *  - r: Sólo lectura. Puntero al principio del fichero.
         *  - r+: Lectura y escritura. Puntero al principio del fichero.
         *  - w: Sólo escritura. Puntero al principio del fichero.
         *  - w+: Lectura y escritura. Puntero al principio del fichero.
         *  - a: Sólo escritura. Puntero al final del fichero.
         *  - a+: Lectura y escritura. Puntero al final del fichero.
         *  - x: Sólo escritura. Borra el fichero.
         *  - x+: Lectura y escritura. Borra el fichero.
         *  - b: Modo binario.
         *  - t: Modo texto.
         */
        if (!file_exists($strFile)) {
            echo 'El fichero no existe';
            return;
        }

        if (is_dir($strFile)) {
            echo 'El fichero es un directorio';
            return;
        }

        $fileFlow = fopen($strFile, 'rb+');

        while (!feof($fileFlow)) {
            $textRow = fgets($fileFlow);
            $strSpaces = Functionality::spaces(8);
            $strFinal = $strSpaces . $textRow;
            echo '<p>' . $strFinal . '</p>';
        }

        fclose($fileFlow);
    }

    private static function spaces(int $intSpaces): string
    {
        return str_repeat('&nbsp;', $intSpaces);
    }

    public static function writeFileString(string $strFilePath, string $strContent): void
    {
        $strContent .= PHP_EOL;

        $fileFlow = fopen($strFilePath, 'ab+');

        fwrite($fileFlow, $strContent, strlen($strContent));

        fclose($fileFlow);
    }

    public static function writeFileArr(string $strFilePath, array $strContent): void
    {

        $fileFlow = fopen($strFilePath, 'ab+');

        foreach ($strContent as $frase){
            $frase .= PHP_EOL;
            fwrite($fileFlow, $frase, strlen($frase));
        }

        fclose($fileFlow);
    }

    public static function modifyFileLine(string $filePath, int $lineNumber, string $newContent): void
{
    // Check if the file exists
    if (!file_exists($filePath)) {
        echo "The file does not exist.";
        return;
    }

    // Read the file into an array
    $fileContent = file($filePath);

    // Check if the line number is valid
    if ($lineNumber < 1 || $lineNumber > count($fileContent)) {
        echo "Invalid line number.";
        return;
    }

    // Replace the specified line with the new content
    $fileContent[$lineNumber - 1] = $newContent . PHP_EOL;

    // Write the updated content back to the file
    file_put_contents($filePath, $fileContent);
}

    public static function modifyreadFile(string $strFile,string $strNuevaCadena): void
    {
        /**
         * Opciones de apertura de un fichero:
         *  - r: Sólo lectura. Puntero al principio del fichero.
         *  - r+: Lectura y escritura. Puntero al principio del fichero.
         *  - w: Sólo escritura. Puntero al principio del fichero.
         *  - w+: Lectura y escritura. Puntero al principio del fichero.
         *  - a: Sólo escritura. Puntero al final del fichero.
         *  - a+: Lectura y escritura. Puntero al final del fichero.
         *  - x: Sólo escritura. Borra el fichero.
         *  - x+: Lectura y escritura. Borra el fichero.
         *  - b: Modo binario.
         *  - t: Modo texto.
         */
        if (!file_exists($strFile)) {
            echo 'El fichero no existe';
            return;
        }

        if (is_dir($strFile)) {
            echo 'El fichero es un directorio';
            return;
        }

        $fileFlow = fopen($strFile, 'rb+');

        while (!feof($fileFlow)) {
            $textRow = fgets($fileFlow);
            if(str_contains($textRow, 'Titulo:')){
                $strCadenaCompleta="Titulo: ".$strNuevaCadena.PHP_EOL;
                file_put_contents($strFile, $strCadenaCompleta);
              fwrite($fileFlow, $strCadenaCompleta, strlen($strCadenaCompleta));
            }
            $strSpaces = Functionality::spaces(8);
            $strFinal = $strSpaces . $textRow;
            echo '<p>' . $strFinal . '</p>';
        }

        fclose($fileFlow);
    }

        public static function deleteFile($filePath) {
        if (file_exists($filePath)) {
            if(unlink($filePath)) {
                return "File deleted successfully";
            } else {
                return "Failed to delete the file";
            }
        } else {
            return "File does not exist";
        }
    }


   public static function imprimirMultiplesAPIS($arrInfoPersonaje)
   {

       echo "<table border='1px'>";

       foreach ($arrInfoPersonaje as $clave => $valor) {

           if (!empty($valor)) {
               print_r($valor);
               if (is_array($valor)) {
                   echo "<td>" . $clave . "</td>";
                   echo "<td>";
                   print_r($valor);
                   foreach ($valor as $valor2) {
                       print_r($valor2);
                       $datosApi = Functionality::getJSON($valor2);

                       if (array_key_exists('title', $datosApi)) {
                           echo $datosApi['title'] . "<br>";
                       } else {
                           echo $datosApi['name'] . "<br>";
                       }
                   }
                   echo "</tr>";

               } else {
                   echo "<td>" . $clave . "</td>";
                   if (Functionality::comprobarURL($valor)) {
                       $valor = Functionality::getJSON($valor);
                       echo "<td>" . $valor['name'] . "</td><tr>";
                   } else {
                       echo "<td>" . $valor . "</td><tr>";
                   }
               }
           } else {
               echo "<td>" . $clave . "</td>";
               echo "<td> No hay datos</td><tr>";
           }
       }
       echo "</table>";

     }

     public static function comprobarURL($strParametro){
         if (str_contains($strParametro, "https://")) {

             return true;

         } else {
             return null;
         }
     }
}