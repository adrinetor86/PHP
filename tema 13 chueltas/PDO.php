<?php
function generarConexion(): PDO | null {
    $strGestorBD = 'mysql';
    $strHost = 'localhost';
    $strPuerto = '3307';
    $strNombreBD = 'juego';
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

function select(): void {
    $strTablaAcceso = 'USERS';
    $strComandoSQL = 'SELECT * FROM ' . $strTablaAcceso;

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
                echo 'Registros encontrados: ' . $intCantRegistros;
                while ($filaUsuario = $secuencia -> fetch()) {
                    foreach ($filaUsuario as $key => $value) {
                        echo $key . ' ' . $value . '<br />';
                    }
                }
            } else {
                echo 'La tabla ' . $strTablaAcceso . ' no contiene registros.';
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $secuencia);
    }
}

function selectUsuario(string $dni): void {
    $strTablaAcceso = 'USERS';
    $strComandoSQL = 'SELECT * FROM ' . $strTablaAcceso . ' WHERE DNI = :dni';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();
        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':dni', $dni);
            $SQLStatement -> setFetchMode(PDO::FETCH_ASSOC);
            $SQLStatement -> execute();

            if ($filaUsuario = $SQLStatement -> fetch()) {
                foreach ($filaUsuario as $key => $value) {
                    echo $key . ' ' . $value . '<br />';
                }
            } else {
                echo 'NO EXISTE UN USUARIO CON EL DNI ' . $dni . '.';
            }
        }
    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}

function insert(array $datosNuevoUsuario): void {
    $strTablaAcceso = 'USERS';
    $strComandoSQL = 'INSERT INTO ' . $strTablaAcceso
        . ' (DNI, NOMBRE, APELLIDO, TELEFONO) VALUES (:dni, :nombre, :apellido, :telefono)';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();

        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':dni', $datosNuevoUsuario['dni']);
            $SQLStatement -> bindParam(':nombre', $datosNuevoUsuario['nombre']);
            $SQLStatement -> bindParam(':apellido', $datosNuevoUsuario['apellido']);
            $SQLStatement -> bindParam(':telefono', $datosNuevoUsuario['telefono']);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR EN LA INSERCIÓN DE LOS DATOS EN LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}

function update(array $nuevosDatosUsuario): void {
    $strTablaAcceso = 'USERS';
    $strComandoSQL = 'UPDATE ' . $strTablaAcceso
        . ' SET NOMBRE = :nombre,'
        . ' APELLIDO = :apellido,'
        . ' TELEFONO = :telefono'
        . ' WHERE DNI = :dni';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();
        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':nombre', $nuevosDatosUsuario['nombre']);
            $SQLStatement -> bindParam(':apellido', $nuevosDatosUsuario['apellido']);
            $SQLStatement -> bindParam(':telefono', $nuevosDatosUsuario['telefono']);
            $SQLStatement -> bindParam(':dni', $nuevosDatosUsuario['dni']);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR AL ACTUALIZAR LOS DATOS EN LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}

function delete(string $dni): void {
    $strTablaAcceso = 'USERS';
    $strComandoSQL = 'DELETE FROM ' . $strTablaAcceso . ' WHERE DNI = :dni';

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();
        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':dni', $dni);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR AL BORRAR DATOS DE LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}