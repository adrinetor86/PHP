<?php
include ("ticket.php");
class factura extends ticket {

    protected string $strDni;
    protected string $strMatricula;

    public function __construct($importe,$strDni,$strMatricula){

        $this->strFecha=date('Y-m-d');
        $this->strHora=date('H:i:s');
        $this->strDni=$strDni;
        $this->strMatricula=$strMatricula;

        parent::__construct($importe);

    }


    public function getDni(){
        return $this->strDni;
    }
    public function getMatricula(){
        return $this->strMatricula;
    }

    public function meterArr(): array{


        $arrFactura['fecha']=$this->strFecha;
        $arrFactura['hora']=$this->strHora;
        $arrFactura['importe']=$this->importe;
        $arrFactura['dni']=$this->strDni;
        $arrFactura['matricula']=$this->strMatricula;
            return $arrFactura;


    }
}
?>