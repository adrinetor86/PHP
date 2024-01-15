<?php
include_once ("Trabajador.php");
class Empleado extends Trabajador {

    protected ?int $edad;

    protected ?int $horasTrabajadas;
    protected ?int $precioHora;

        public function __construct(?string $strNombre, ?string $strApellido,$edad,$horasTrabajadas,$precioHora){

            $this->edad=$edad;
            $this->horasTrabajadas=$horasTrabajadas;
            $this->precioHora=$precioHora;

            parent::__construct($strNombre, $strApellido);
        }

        function calcularSueldo(){


        return $this->horasTrabajadas * $this->precioHora;

        }





}