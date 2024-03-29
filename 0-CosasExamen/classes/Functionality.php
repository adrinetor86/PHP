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

    public static function writeFile(string $strFilePath, string $strContent): void
    {
        $strContent .= PHP_EOL;

        $fileFlow = fopen($strFilePath, 'ab+');

        fwrite($fileFlow, $strContent, strlen($strContent));

        fclose($fileFlow);
    }

    public static function writeFileArray(string $strFilePath, array $arrData): void
    {
        $fileFlow = fopen($strFilePath, 'wb+');

        foreach ($arrData as $strLine) {
            fwrite($fileFlow, $strLine . PHP_EOL, strlen($strLine) + 1);
        }

        fclose($fileFlow);
    }
}