<?php
require_once 'config/config.php';

class Db {

    public static function conectarBD() {

        $host = constant('DB_HOST');
        $db = constant('DB');
        $user = constant('DB_USER');
        $pass = constant('DB_PASS');

        try {
            $conection = new PDO('mysql:host='.$host.';port=3307 ; dbname='.$db, $user, $pass);
        } catch (PDOException $e) {
            echo "error en la base de datos " . $e->getMessage();
            exit();
        }
        return $conection;
    }

}

?>