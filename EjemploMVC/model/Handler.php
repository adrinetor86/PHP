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
        $this->arrProperties['params']= array_slice($arrParams, 3);

       //print_r($arrParams);
       // echo "<br>Ruta: ".$strRuta;
        $intCont=0;
    }

    public function getController(){
        return $this->arrProperties['controller'];
    }
      public function getAction(){
          return $this->arrProperties['action'];
      }
      public function getParams(){
          return $this->arrProperties['params'];
      }

      public function getProperties(): array {


            if($this->arrProperties['controller']=="ControladorNota"){

                    $_GET['controller']='ControladorNota';

                switch ($this->arrProperties['action']){

                    case "list": $_GET['action']="list";break;

                    case "edit": $_GET['action']="edit";break;

                    case "delete": $_GET['action']="delete";break;

                }

            }

          return $this->arrProperties;
      }

  }