<?php
include './config/config.php';
class Handler {
    private array $arrProperties; // Array que guardara las propiedades controlador, acción y parámetros de la URL.
    private string $defaultURL; // URL por defecto (el inicio del programa)

    public function __construct() {
        $this->arrProperties = []; // Inicializamos un array vacío para la propiedad arrProperties.
        $this->fillProperties(); // Llamada a la función fillProperties()
    }

    /**
     * Función encargada de rellenar el array $arrProperties.
     * @return void
     */
    private function fillProperties(): void {
        // Formateamos nuestra URL para que contenga el protocolo http, el nombre del servidor y la URI como tal.
        $strUri = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        // Realizamos una comprobación de que la URI es correcta a través del método parse_url(string).
        $arrParseURL = parse_url($strUri);

        if (is_array($arrParseURL)) { // En el caso de que el resultado de parse_url haya sido un array.
            // Dividimos la URI en 2 a partir de la URL por defecto (constante definida en el archivo config.php).
            // Por ejemplo la URI:
            // https://127.0.0.1/EjerciciosServidor/UD14/pruebaHandler.php/controlador/accion/parametro1/parametro2
            // Tendrá dos índices:
            // [0] => 'https://127.0.0.1/EjerciciosServidor/UD14/'
            // [1] => '/controlador/accion/parametro1/parametro2'
            // Por eso nos quedamos con el índice [1] porque es el que nos interesa.
            $arrUri = explode(constant('DEFAULT_URL'), $strUri)[1];

             echo " Prueba uri";
             print_r($arrUri);
            // Este índice 1 lo volvemos a dividir pero ahora por la /
            // En el ejemplo '/controlador/accion/parametro1/parametro2' quedaría así:
            // [0] = ''
            // [1] = 'controlador'
            // [2] = 'accion'
            // [3] = 'parametro1'
            // [4] = 'parametro2'
            $arrParams = explode('/', $arrUri);
            echo " <br>PRUEBA ";
            print_r($arrParams);
            // Añadimos cada valor a su correspondiente propiedad del array
            // Controller: Añade el $arrParams[1] si está seteado en la URL, si no lo está guarda un ''.
            $this->arrProperties['controller'] = $arrParams[1] ?? '';

            // Sería lo mismo que hacer
            /*
             * $this->arrProperties['controller'] = isset($arrParams[1]) ? $arrParams[1] : '';
             */

            // Action: Añade el $arrParams[2] si está seteado en la URL, si no lo está guarda un ''.
            $this->arrProperties['action'] = $arrParams[2] ?? '';

            // Sería lo mismo que hacer
            /*
             * $this->arrProperties['action'] = isset($arrParams[2]) ? $arrParams[2] : '';
             */

            // Parameters: Guarda un array a partir de $arrParams[3] en adelante.
            // Si no hay parámetros guarda un array vacío.
            $this->arrProperties['parameters'] = array_slice($arrParams, 3);

            // Esto último sería lo mismo que hacer esto:
            /*
            * for ($intCont = 3; $intCont < count($arrParams); $intCont++) {
            *     $this->arrProperties['parameters'][] = $arrParams[$intCont];
            * }
            */
        }
    }

    /**
     * Función encargada de devolver el valor del controlador.
     * @return string - Devuelve un String con el valor del controlador.
     */
    public function getController(): string {
        return $this->arrProperties['controller'];
    }

    /**
     * Función encargada de devolver el valor de la acción.
     * @return string - Devuelve un String con el valor de la acción.
     */
    public function getAction(): string {
        return $this->arrProperties['action'];
    }

    /**
     * Función encargada de devolver el array de parámetros.
     * @return array - Devuelve un array con los parámetros.
     */
    public function getParameters(): array {
        return $this->arrProperties['parameters'];
    }

    /**
     * Función encargada de devolver el array de propiedades.
     * @return array - Devuelve un array con las propiedades.
     */
    public function getProperties(): array {
        return $this->arrProperties;
    }
}