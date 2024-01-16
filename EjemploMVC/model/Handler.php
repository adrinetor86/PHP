<?php


class Handler{


    private array $arrProperties;



    public function __construct(){

        $this->arrProperties=[];
        $this->valoresUrl();
        //   for(;$arrUrl[$intCont]!='index.php' && $intCont<count($arrUrl)-1;$intCont++);
//
//        for($intCont2=1; $intCont<count($arrUrl); $intCont++, $intCont2++)
//            echo "<br>Elemento $intCont2: $arrUrl[$intCont] <br />";

    }

    private function valoresUrl(){
        $strDominio="http://".$_SERVER['SERVER_NAME'];

        $strUri=$strDominio.''.$_SERVER['REQUEST_URI'];

        $arrParseUrl=parse_url($strUri);

        $strRuta=$arrParseUrl['path'];

        //    echo $strDominio;

        //  echo "<br><br>".$strUri."<br><br>";
        //print_r($strUri);
        //  echo "<br>";
        //Dividimos la uri en 2, y nos quedamos la 2 parte
        $arrUri=explode("index.php",$strUri)[1];

        // print_r($arrUri);
        // echo "<br>";
        $arrParams = explode('/', $arrUri);


        $this->arrProperties['controller'] = $arrParams[1] ?? '';
        $this->arrProperties['action'] = $arrParams[2] ?? '';

        //Pasa un trozo del array
        $auxParametros=array_slice($arrParams, 3);
        $this->arrProperties['parametros']=[];


        if ($auxParametros !== []) {
            switch ($this->arrProperties['controller']) {
                case 'ControladorNota':
                    switch ($this->arrProperties['action']) {
                        case 'list':
                            $this->arrProperties['parametros']['page'] = $auxParametros[0] ?? '';
                            break;
                        case 'save':
                        case 'edit':
                        case 'confirmDelete':
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

        //print_r($arrParams);
        // echo "<br>Ruta: ".$strRuta;
        $intCont=0;
//             $_GET['id']=$this->arrProperties['parametros'][0];
//            echo "EL ID DE LOS HUEVOS ".$this->arrProperties['parametros']['id'];
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