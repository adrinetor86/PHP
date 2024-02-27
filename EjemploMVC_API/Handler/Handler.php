<?php

class Handler
{


    private array $arrProperties;


    public function __construct()
    {

        $this->arrProperties = [];
        $this->valoresUrl();

    }

    private function valoresUrl()
    {

        $strDominio = "http://" . $_SERVER['SERVER_NAME'];

        $strUri = $strDominio . '' . $_SERVER['REQUEST_URI'];


        $arrParseUrl = parse_url($strUri);

        if (is_array($arrParseUrl) && str_contains($strUri, ".php")) {

            $strRuta = $arrParseUrl['path'];

            //Dividimos la uri en 2, y nos quedamos la 2 parte
            $arrUri = explode("index.php", $strUri)[1];

            $arrParams = explode('/', $arrUri);


            $this->arrProperties['tabla'] = $arrParams[1] ?? '';

            $this->arrProperties['action'] = $arrParams[2] ?? '';
            //COGE A PARTIR DE LA UBICACION 2 DEL ARRPARAMS EN ADELANTE
            $auxParametros= array_slice($arrParams, 3);
            $this->arrProperties['parametros']=[];
            //Pasa un trozo del array

        }
        if ($auxParametros !== []) {
            switch ($this->arrProperties["action"]) {

                case 'list':
                case 'siguientePagina':

                    $this->arrProperties['parametros']['page'] = $auxParametros[0] ?? '';
                    if (!empty($this->arrProperties['parametros']['page'])
                        && isset($_SESSION['maxPage'])
                        && $this->arrProperties['parametros']['page'] > $_SESSION['maxPage']) {

                        echo "Paginas maximas :" . $_SESSION['maxPage'];
                        $this->arrProperties['parametros']['page'] = $_SESSION['maxPage'];
                    } elseif ($this->arrProperties['parametros']['page'] < 1) {
                        $this->arrProperties['parametros']['page'] = 1;
                    }
                    break;
              }
            }


    }

    public function getTabla()
    {
        return $this->arrProperties['tabla'] ?? '';
    }

    public function getAction()
    {
        return $this->arrProperties['action'] ?? '';
    }
    public function getParams()
    {
        echo "&&&&&&&&&&&&&".$this->arrProperties['parametros'];
        return $this->arrProperties['parametros'] ?? '';
    }

    public function getProperties(): array
    {

        return $this->arrProperties;
    }

}