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

    if(is_array($arrParseUrl) && str_contains($strUri,".php")){

    $strRuta=$arrParseUrl['path'];

    //Dividimos la uri en 2, y nos quedamos la 2 parte
    $arrUri=explode("index.php",$strUri)[1];

    $arrParams = explode('/', $arrUri);


    $this->arrProperties['controller'] = $arrParams[1] ?? '';
    $this->arrProperties['action'] = $arrParams[2] ?? '';

    //Pasa un trozo del array
    $auxParametros=array_slice($arrParams, 3);
    $this->arrProperties['parametros']=[];


    if ($auxParametros !== []) {
        switch ($this->arrProperties['controller']) {

             case 'ControladorLibros':
              switch ($this->arrProperties['action']) {

                case 'listarLibros':
                //PONGO 1
                $this->arrProperties['parametros']['page'] = $auxParametros[0] ?? '';

//                if(!empty($this->arrProperties['parametros']['page'])
//                && isset($_SESSION['maxPage'])
//                && $this->arrProperties['parametros']['page'] > $_SESSION['maxPage']) {
//
//                //echo "Paginas maximas :" .$_SESSION['maxPage'];
//                $this->arrProperties['parametros']['page'] = $_SESSION['maxPage'];
//
//                }elseif ($this->arrProperties['parametros']['page'] < 1){
//
//                $this->arrProperties['parametros']['page']=1;
//                }
                    break;
                case 'save';
                case 'listarLibro':
                case 'editarLibro':
                case 'eliminarLibro':
                $this->arrProperties['parametros']['id'] = $auxParametros[0] ?? '';
                break;
                }
        break;
        //                case 'ControladorLogin':
        //                    switch ($this->arrProperties['action']) {
        //                        case 'checkPassword':
        //                        case 'logout':
        //                            $this->arrProperties['parameters'] = [];
        //                    }
        //                    break;

        }
        }
        }

    }

    public function getController(){
    return $this->arrProperties['controller'];
    }
    public function getAction(){
    return $this->arrProperties['action'];
    }
    public function getParams(){
    return $this->arrProperties['parametros'];
    }

    public function getProperties(): array {

    return $this->arrProperties;
    }

}