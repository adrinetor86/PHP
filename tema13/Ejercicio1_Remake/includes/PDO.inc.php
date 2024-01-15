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
    $strTablaAcceso = 'heroe';
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
                echo 'Registros encontrados: ' . $intCantRegistros.'</br>';
                while ($filaUsuario = $secuencia -> fetch()) {
                    foreach ($filaUsuario as $key ) {
                        echo "Heroe " . $key .' ';

                    }

                    echo "<form>";
                    echo '&nbsp &nbsp <button type="submit" formaction="./paginas/borrar.php" name="id" value='.$filaUsuario['id'].'">Borrar</button>';

                    echo '&nbsp &nbsp <button type="submit" formaction="./paginas/editar.php" name="id" value='.$filaUsuario['id'].'">Editar</button><br/></br>';
                    echo "</form>";

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

function selectHeroe(string $id): void {


    $strTablaAcceso = 'heroe';
    $strComandoSQL = "SELECT * FROM " . $strTablaAcceso . " WHERE id= '".$id."'";

    $PDOConexion = null;
    $sentenciaSQL = null;

    try {
        $PDOConexion = generarConexion();
        if ($PDOConexion) {
            $sentenciaSQL = $PDOConexion -> prepare($strComandoSQL);
           // $sentenciaSQL -> bindParam(':id', $id);
            $sentenciaSQL -> setFetchMode(PDO::FETCH_ASSOC);
            $sentenciaSQL -> execute();
            echo "<form>";
            while ($heroe = $sentenciaSQL->fetch()) {
                foreach ($heroe as $clave =>$valor){
                    echo $clave .': '.$valor ."<br>";
                }


                echo "<input type='text' placeholder='nombre' name='nombre' id=nombreHeroe' value='".$heroe['nombre']."' ><br>";
                echo "<input type='text' placeholder='rol' name='rol' value='".$heroe['rol']."'><br> ";
                echo "<input type='text' placeholder='dificultad' name='dificultad' value='".$heroe['dificultad']."'><br>";
                echo "<input type='text' placeholder='descripcion' name='descripcion' value='".$heroe['descripcion']."'><br>";
                echo "<button type='submit' formaction='../index.php' value='Confirmar'>Volver</button>";
                echo "<button type='submit' formaction='../paginas/actualizar.php' name='id' value='".$heroe['id']."'>Confirmar</button>";
            }


            echo "</form>";
            } else {
                echo 'NO EXISTE UN HEROE CON EL ID ' . $id . '.';
            }

    } catch (PDOException $e) {
        echo 'ERROR EN EL ACCESO A LOS DATOS DE LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $sentenciaSQL);
    }
}
/*
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
        cierraConexion($PDO?Conexion, $SQLStatement);
    }
}
*/

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

function delete(string $id): void {
    $strTablaAcceso = 'heroe';
    $strComandoSQL = "DELETE FROM " . $strTablaAcceso . " WHERE id = :id";

    $PDOConexion = null;
    $SQLStatement = null;

    try {
        $PDOConexion = generarConexion();
        if ($PDOConexion) {
            $SQLStatement = $PDOConexion -> prepare($strComandoSQL);
            $SQLStatement -> bindParam(':id', $id);
            $SQLStatement -> execute();
        }
    } catch (PDOException $e) {
        echo 'ERROR AL BORRAR DATOS DE LA TABLA ' . $strTablaAcceso . '.';
    } finally {
        cierraConexion($PDOConexion, $SQLStatement);
    }
}