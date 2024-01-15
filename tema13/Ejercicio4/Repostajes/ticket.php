<?php

class ticket{

    protected string $strFecha;
    protected string $strHora;
    protected int $importe;

    public function __construct($importe) {

        $this->strFecha=date('Y-m-d');
        $this->strHora=date('H:i:s');
        $this->importe=$importe;
    }

    public function getFecha(){

        return $this->strFecha;
    }
    public function getHora(){

        return $this->strHora;
    }
    public function getImporte(){

        return $this->importe;
    }

    public function meterArr():array{
        $arrTicket['fecha']=$this->strFecha;
        $arrTicket['hora']=$this->strHora;
        $arrTicket['importe']=$this->importe;

        return $arrTicket;
    }
}

?>