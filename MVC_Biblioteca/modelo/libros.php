<?php


    require_once ("Db.php");

    class Libros
    {

        private $tabla = 'libros';

        private $conection;


        public function __construct()
        {

            $this->tabla = "libros";
            $this->conection = DB::conectarBD();
        }

        public function mostrarLibros(){

            $sql = 'SELECT * FROM ' . $this->tabla;
            // echo $sql."<br>";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt->rowCount();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function mostrarLibroId($libro){


            print_r($libro);
            $sql = 'SELECT * FROM ' . $this->tabla . ' WHERE idLibro=?';

            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$libro['id']]);
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt->rowCount();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function Confirmareditar($libro){

            $id = $libro['idLibro'];
            $titulo = $libro['titulo'];
            $genero = $libro['genero'];
            $pais = $libro['pais'];
            $ano = $libro['ano'];
            $paginas = $libro['numPaginas'];

            echo "PAGINAS: " . $paginas;

            $sql = "UPDATE " . $this->tabla . " SET titulo=?, genero=?, pais=? , ano=?, numPaginas=? WHERE idLibro=?";

            $stmt = $this->conection->prepare($sql);

            $stmt->execute([$titulo, $genero, $pais, $ano, $paginas, $id]);

            return $libro;
        }


        public function delete($param){

            $libro=$this->mostrarLibroId($param);

                return $libro;
        }

        public function confirmarDelete($libro){
            print_r($libro);
            $sql = "DELETE  FROM " . $this->tabla . " WHERE idLibro= ?";

            $stmt = $this->conection->prepare($sql);

            print_r($libro);

            $stmt->execute([$libro]);

            return $libro;
        }

        public function edit($param){

            $libro = $this->mostrarLibroId($param);
            return $libro;

        }


        public function insert($Post){

           // INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('Manolito Gafotas','infantil','España',1994,192);

          //  echo $Post['nuevoTitulo'];
            $comprobacion=false;

            foreach ($_POST as $valor){

                echo $valor."<br>";

                if(!empty(trim($valor)) && trim($valor)!=null){

                    $comprobacion=true;
                }else{

                    $comprobacion=false;
                    break;
                }

            }

            if($comprobacion==true ){
          echo "insertado";
                $sql = "INSERT INTO " . $this->tabla . " (titulo,genero,pais,ano,numPaginas) VALUES
                ('".$Post['nuevoTitulo']."','".$Post['nuevoGenero']."','".$Post['nuevoPais']."',
                '".(int)$Post['nuevoAno']."','".(int)$Post['nuevoPag']."')";


                $stmt = $this->conection->prepare($sql);

                $stmt->execute();

            }else{
                echo "Debes rellenar todos los campos";
            }

        }

        public function buscarLibros($post){

            print_r($post);

            $sql = "SELECT *  FROM " . $this->tabla ." WHERE 
             IDLIBRO BETWEEN ".$post['IdMin']." AND ".$post['IdMax'];

            echo "EL sql: ".$sql;
            $stmt = $this->conection->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);


        }

        public function buscarColumna($columna){


            $sql = "SELECT DISTINCT $columna FROM " . $this->tabla ;
            echo "EL sql: ".$sql;
            $stmt = $this->conection->prepare($sql);

             $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
