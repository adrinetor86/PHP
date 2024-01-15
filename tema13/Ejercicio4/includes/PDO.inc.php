<?php
function generarConexion(): PDO | null {
    $strGestorBD = 'mysql';
    $strHost = 'localhost';
    $strPuerto = '3307';
    $strNombreBD = 'repostaje';
    $strUsuarioBD = 'root';
    $strPassBD = '';

    try {
        $PDOConexion = new PDO(
            $strGestorBD
            . ':host=' . $strHost
            . ';port=' .$strPuerto
            . ';dbname=' . $strNombreBD,
            $strUsuarioBD,
            $strPassBD
        );

        $PDOConexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $PDOConexion;
    } catch (PDOException $e) {
        echo 'ERROR EN LA CONEXIÓN A LA BD ' . $strNombreBD . '.';

        return null;
    }
}

function cierraConexion(?PDO $conexion, ?PDOStatement $cursor): void {
    $cursor?->closeCursor();

    if ($conexion !== null) {
        $conexion = null;
    }
}
function selectTicket(): void {
    $strTablaAcceso = 'ticket';

   // echo 'SELECT * FROM ' . $strTablaAcceso.'';
    $strComandoSQL = 'SELECT * FROM ' . $strTablaAcceso.'';

    $PDOConexion = null;
    $secuencia = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $secuencia = $PDOConexion -> prepare($strComandoSQL);
            $secuencia -> setFetchMode(PDO::FETCH_ASSOC);
            $secuencia -> execute();

            $intCantRegistros = $secuencia -> rowCount();

            if ($intCantRegistros > 0) {
            //echo 'Registros encontrados: ' . $intCantRegistros.'</br>';
                while ($filaUsuario = $secuencia -> fetch()) {
                    echo "<br>";
                    foreach ($filaUsuario as $key=>$valor ) {
                        echo $key .' '.$valor.'&nbsp &nbsp';
                    }
                }
            } else {
                echo 'La tabla ' . $strTablaAcceso .' no contiene registros.';
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso .'';
    } finally {
        cierraConexion($PDOConexion, $secuencia);
    }
}

    function selectMultiple(){
        selectFactura();
        selectTicket();
    }


function selectFactura(): void {
    $strTablaAcceso = 'factura';

   // echo 'SELECT * FROM ' . $strTablaAcceso.'';
    $strComandoSQL = 'SELECT * FROM ' . $strTablaAcceso.'';

    $PDOConexion = null;
    $secuencia = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $secuencia = $PDOConexion -> prepare($strComandoSQL);
            $secuencia -> setFetchMode(PDO::FETCH_ASSOC);
            $secuencia -> execute();

            $intCantRegistros = $secuencia -> rowCount();

            if ($intCantRegistros > 0) {

            //    echo 'Registros encontrados: ' . $intCantRegistros.'</br>';
                while ($filaUsuario = $secuencia -> fetch()) {
                    echo "<br>";
                    foreach ($filaUsuario as $key=>$valor ) {
                        echo $key .' '.$valor.'&nbsp &nbsp';

                    }
                }
            } else {
                echo 'La tabla ' . $strTablaAcceso .' no contiene registros.';
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso .'';
    } finally {
        cierraConexion($PDOConexion, $secuencia);
    }
}


function select(): void {
    $strTablaAcceso1 = 'ticket';
    $strTablaAcceso2 = 'factura';
    $strComandoSQL = 'SELECT (SUM('.$strTablaAcceso1.'.importe)+SUM('.$strTablaAcceso2.'.importe))  from '. $strTablaAcceso1.', '.$strTablaAcceso2.' ';

    $PDOConexion = null;
    $secuencia = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $secuencia = $PDOConexion -> prepare($strComandoSQL);
            $secuencia -> setFetchMode(PDO::FETCH_ASSOC);
            $secuencia -> execute();

            $intCantRegistros = $secuencia -> rowCount();

            if ($intCantRegistros > 0) {

                while ($filaUsuario = $secuencia -> fetch()) {
                    foreach ($filaUsuario as $valor ) {
                       echo  $valor.' €';

                    }
                }
            } else {
                echo 'La tabla ' . $strTablaAcceso1 ." o ".$strTablaAcceso2. ' no contiene registros.';
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso1 ." o ".$strTablaAcceso2.'.';
    } finally {
        cierraConexion($PDOConexion, $secuencia);
    }

}
function selectDepositos(): void {
    $strTablaAcceso = 'deposito';

    $strComandoSQL = 'SELECT *  from '. $strTablaAcceso;

    $PDOConexion = null;
    $secuencia = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $secuencia = $PDOConexion -> prepare($strComandoSQL);
            $secuencia -> setFetchMode(PDO::FETCH_ASSOC);
            $secuencia -> execute();

            $intCantRegistros = $secuencia -> rowCount();

            if ($intCantRegistros > 0) {

                while ($filaUsuario = $secuencia -> fetch()) {
                    echo "<br>";
                    foreach ($filaUsuario as $clave => $valor ) {
                        echo $clave.'&nbsp '.$valor.'&nbsp';

                    }
                }
            } else {
                echo 'La tabla ' . $strTablaAcceso .' no contiene registros.';
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso .'';
    } finally {
        cierraConexion($PDOConexion, $secuencia);
    }

}


function insertTicket(array $datosTicket): void {
    $strTablaAcceso = 'ticket';
    $strComandoSQL = 'INSERT INTO ' . $strTablaAcceso
        . ' (fecha, hora, importe) VALUES (:fecha, :hora, :importe)';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':fecha', $datosTicket['fecha']);
            $SQLStatement -> bindParam(':hora', $datosTicket['hora']);
            $SQLStatement -> bindParam(':importe', $datosTicket['importe']);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR EN LA INSERCIÓN DE LOS DATOS EN LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}
function insertFactura(array $datosFactura): void {
    $strTablaAcceso = 'factura';
    $strComandoSQL = 'INSERT INTO ' . $strTablaAcceso
        . ' (fecha, hora, importe,dni,matricula) VALUES (:fecha, :hora, :importe, :dni , :matricula)';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':fecha', $datosFactura['fecha']);
            $SQLStatement -> bindParam(':hora', $datosFactura['hora']);
            $SQLStatement -> bindParam(':importe', $datosFactura['importe']);
            $SQLStatement -> bindParam(':dni', $datosFactura['dni']);
            $SQLStatement -> bindParam(':matricula', $datosFactura['matricula']);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR EN LA INSERCIÓN DE LOS DATOS EN LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}

function insertDeposito(array $datosDeposito): void {
    $strTablaAcceso = 'deposito';
  //  echo 'INSERT INTO ' . $strTablaAcceso  . ' (gasolina, litros, importe) VALUES (:gasolina, :litros, :importe)';

    $strComandoSQL = 'INSERT INTO ' . $strTablaAcceso
        . ' (gasolina, litros, importe) VALUES (:gasolina, :litros, :importe)';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':gasolina', $datosDeposito['tipoGasolina']);
            $SQLStatement -> bindParam(':litros', $datosDeposito['litros']);
            $SQLStatement -> bindParam(':importe', $datosDeposito['importe']);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR EN LA INSERCIÓN DE LOS DATOS EN LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}


function update(array $nuevosDatosUsuario): void {
    $strTablaAcceso = 'heroe';
    $strComandoSQL = 'UPDATE ' . $strTablaAcceso .
        ' SET nombre = :nombre, ' .
        'rol = :rol, ' .
        'dificultad = :dificultad, ' .
        'descripcion = :descripcion ' .
        'WHERE id = :id';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();
        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':nombre', $nuevosDatosUsuario['nombre']);
            $SQLStatement -> bindParam(':rol', $nuevosDatosUsuario['rol']);
            $SQLStatement -> bindParam(':dificultad', $nuevosDatosUsuario['dificultad']);
            $SQLStatement -> bindParam(':descripcion', $nuevosDatosUsuario['descripcion']);
            $SQLStatement -> bindParam(':id', $nuevosDatosUsuario['id']);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR AL ACTUALIZAR LOS DATOS EN LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}

function borrarDeposito(): bool {
    $strTablaAcceso = 'deposito';

    echo "DELETE FROM ". $strTablaAcceso ." WHERE id=(SELECT max(id) from $strTablaAcceso)";
    $strComandoSQL = "DELETE FROM ". $strTablaAcceso ." WHERE id=(SELECT max(id) from $strTablaAcceso)";

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> execute();
            return true;
        }
    } catch (PDOException $e) {
        echo 'ERROR AL BORRAR DATOS DE LA TABLA ' . $strTablaAcceso . '.';
        return false;
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
    return false;
}