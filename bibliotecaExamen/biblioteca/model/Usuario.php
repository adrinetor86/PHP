<?php

class Usuario
{
    private $table = 'usuarios';

    public static function logado(): bool{
        $blnRespuesta=false;
        if(isset($_SESSION['usuario']))
            $blnRespuesta = true;

        return $blnRespuesta;
    }

    public function loginOK(string $strCorreo, string $strPassword): bool{
        $conection = Db::conectarBD();
        $sql = "SELECT * FROM ".$this->table. " WHERE email = ? and password = ?";
        $stmt = $conection->prepare($sql);
        $stmt->execute([$strCorreo, $strPassword]);
        if($stmt->fetch()) {
            $_SESSION['usuario'] = $strCorreo;
            return true;
        }else
            return false;
    }
}