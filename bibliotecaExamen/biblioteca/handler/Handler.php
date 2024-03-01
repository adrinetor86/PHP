<?php 

class Handler {
	private string $strControlador='';
    private string $strAccion='';
    private array $arrStrParam=[];

	public function __construct() {
        $this->strControlador='';
        $this->strAccion='';
        $this->arrStrParam=[];
        if(!Usuario::logado()){ // lo normal sería poner isset($_SESSION['usuario'])
            $this->strControlador = 'ControladorUsuario';
            $this->strAccion = 'login';
        }else{
            $arrUrl = explode("/",$_SERVER['REQUEST_URI']);
            $intCont=0;
            for(;$intCont<count($arrUrl) && $arrUrl[$intCont]!='index.php'; $intCont++);

            if(count($arrUrl)>$intCont+2) {
                $this->strControlador = $arrUrl[++$intCont];
                $this->strAccion = $arrUrl[++$intCont];
                $this->arrStrParam = array_slice($arrUrl, ++$intCont);
//                $this->asociativo();
            }
        }

	}

    public function getControlador(): ?string{
        // si no existe el controlador o la acción cargo los valores por defecto
        // se podría poner solo la línea return $this->strControlador??constant("DEFAULT_CONTROLLER");
        $this->strControlador = $this->strControlador??constant("DEFAULT_CONTROLLER");
        return $this->strControlador;
    }

    public function getAccion(): ?string{
        // se podría dejar en una línea como en getControlador()
        $this->strAccion = $this->strAccion??constant("DEFAULT_ACTION");
        return $this->strAccion;
    }

    public function getParametros(): ?array{
        return $this->arrStrParam??null;
    }

    //genera un array asociativo con los parámetros
    public function asociativo(){
        $arrAux=$this->arrStrParam; 
        $this->arrStrParam=[];
        if($this->strControlador==='ControladorNota') {
            switch ($this->strAccion) {
                case 'list':
                    if(isset($arrAux) && count($arrAux)>0)
						$this->arrStrParam['pagina'] = $arrAux[0];
                    break;
                case 'edit':
                case  'confirmDelete':
                    if(isset($arrAux) && count($arrAux)>0)
						$this->arrStrParam['id'] = $arrAux[0];
                    break;
            }
        }
    }

    // se pone el controlador y la acción por defecto si está logado y sino que se loge
    public function setDefecto(){
        if(Usuario::logado()) {
            $this->strControlador = constant("DEFAULT_CONTROLLER");
            $this->strAccion = constant("DEFAULT_ACTION");
        }else{
            $this->strControlador = 'ControladorUsuario';
            $this->strAccion = 'login';
        }
        $this->arrStrParam=[];
    }
}

?>