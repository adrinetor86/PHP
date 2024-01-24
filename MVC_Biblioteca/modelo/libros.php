<?php


    require_once ("Db.php");

    class Libros{

        private $tabla='libros';

        private $conection;


        public function __construct(){

            $this->tabla="libros";
            $this->conection=DB::conectarBD();
        }

        public function mostrarLibros(){

            $sql= 'SELECT * FROM '. $this->tabla ;
            // echo $sql."<br>";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt -> rowCount();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function mostrarLibroId($libro){

            //print_r($id);
           // echo "BUENASSS ".$id['id']."<br>";

            $sql= 'SELECT * FROM '. $this->tabla .' WHERE idLibro=?';

            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$libro['id']]);
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt -> rowCount();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }


        public function Confirmareditar($libro){


                $id=  $libro['idLibro'];
                $titulo=$libro['titulo'];
                $genero=$libro['genero'];
                $pais=$libro['pais'];
                $ano=$libro['ano'];
                $paginas=$libro['numPaginas'];

                echo "PAGINAS: ".$paginas;

            $sql = "UPDATE ".$this->tabla. " SET titulo=?, genero=?, pais=? , ano=?, numPaginas=? WHERE idLibro=?";


           // print_r($libro);
          //  echo $sql;
            $stmt = $this->conection->prepare($sql);
           // echo "TITULO NUEVO ".$titulo;
            $stmt->execute([$titulo, $genero, $pais, $ano, $paginas,$id]);




                return $libro;

        }
        public function edit($param){


               // print_r($param);
            $libro=$this->mostrarLibroId($param);

            //print_r($libro);

            $id=$libro['idLibro'];
            $titulo=$libro['titulo'];
            $genero=$libro['genero'];
            $pais=$libro['pais'];
            $ano=$libro['ano'];
            $paginas=$libro['numPaginas'];

//            foreach ($libro as $datosLibro){
//
//                $id=$datosLibro['idLibro'];
//                $titulo=$datosLibro['titulo'];
//                $genero=$datosLibro['genero'];
//                $pais=$datosLibro['pais'];
//                $ano=$datosLibro['ano'];
//                $paginas=$datosLibro['numPaginas'];
//            }


            echo "EL GENERO: ".$genero;

//            $sql = "UPDATE ".$this->tabla. " SET titulo=?, genero=?, pais=? , ano=?, numPaginas=? WHERE idLibro=?";
//
//            echo $sql;
//            $stmt = $this->conection->prepare($sql);
//            echo "TITULO NUEVO ".$titulo;
//             $stmt->execute([$titulo, $genero, $pais, $ano, $paginas,$id]);
//
//            // echo $sql."<br>";
//            $stmt = $this->conection->prepare($sql);

            // $fila = $stmt->fetch();


        return $libro;

        }

    }