<?php
class Handler{

    private array $arrProperties;

    public function __construct(){
        $this->arrProperties=[];
        $this->valoresUrl();
    }


    private function valoresUrl(){

        $strDominio="http://".$_SERVER['SERVER_NAME'];

        $strUri=$strDominio.''.$_SERVER['REQUEST_URI'];

        $arrParseUrl=parse_url($strUri);
        //echo  $strUri=urldecode($strUri);

        if(is_array($arrParseUrl) && str_contains($strUri,".php")) {

            $strRuta = $arrParseUrl['path'];

            //Dividimos la uri en 2, y nos quedamos la 2 parte
            $arrUri = explode("index.php", $strUri)[1];

            $arrParams = explode('/', $arrUri);

            $this->arrProperties['tabla'] = $arrParams[1] ?? '';

            //COGE A PARTIR DE LA UBICACION 2 DEL ARRPARAMS EN ADELANTE
            $this->arrProperties['parametros'] = array_slice($arrParams, 2);


        }
    }

    public function getTabla(){
        return $this->arrProperties['tabla'] ?? '';
    }
    public function getParams(){
        return $this->arrProperties['parametros'] ?? '';
    }

    public function getProperties(): array {

        return $this->arrProperties;
    }

}