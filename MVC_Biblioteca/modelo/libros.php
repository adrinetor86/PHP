<?php


    require_once ("Db.php");

    class Libros
    {

        private $tabla = 'libros';

        private $conection;


        public function __construct(){

            $this->tabla = "libros";
            $this->conection = DB::conectarBD();
            $this-> objAutores=new Autores();
        }

        public function mostrarLibros(){

          //  $sql = 'SELECT * FROM ' . $this->tabla;

         $sql  = ' SELECT idLibro,titulo,genero,pais,ano,numPaginas from libros';

            // echo $sql."<br>";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt->rowCount();

            $libros=[];

                    //Mientras que libro reciba datos se ejecuta el while
            while($libro=$stmt->fetch(PDO::FETCH_ASSOC)){

              $arrAutores= $this->aniadeAutores($libro);

              foreach ($arrAutores as $autor){

                  //Meto el [] para que en caso de que haya varios valores, no se sobreescriban
                  $libro['idPersona'][]=$autor['idPersona'];
                  $libro['nombreCompleto'][]=$autor['nombreCompleto'];
              }
            //  print_r($libro);
                //Mete al array libros los datos de libro
            array_push($libros,$libro);
            }

          //  print_r($libros);
            return $libros;
        }

        //Devuelve UN ARRAY CON LOS RESULTADOS ENCONTRADOS DE AUTORES POR IDLIBRO
        private function aniadeAutores($libro){

                $autor=new Autores();
        //Devuelve un array con los autores por id de libro
            return $autor->mostrarAutoresPorId($libro['idLibro']);
        }

        public function mostrarAutores(){

            $sql=" SELECT * FROM AUTORES";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function mostrarLibroId($libro){

            $sql = "SELECT * FROM LIBROS,ESCRIBEN,AUTORES WHERE LIBROS.idLibro=? AND ESCRIBEN.idLibro = LIBROS.idLibro AND ESCRIBEN.idPersona = AUTORES.idPersona";

            $stmt = $this->conection->prepare($sql);
            $stmt->execute([$libro['id']]);
            // $fila = $stmt->fetch();
            $intCantRegistros = $stmt->rowCount();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function Confirmareditar($libro){
          //  $libro['autores'] =$this->mostrarAutores();
            $idLibro = $libro['idLibro'];
            $titulo = $libro['titulo'];
            $genero = $libro['genero'];
            $pais = $libro['pais'];
            $ano = $libro['ano'];
            $paginas = $libro['numPaginas'];
            $idPersona =$libro['Autor'];

           // print_r($libro);
            echo "PAGINAS: " . $paginas;

            $sql= "UPDATE LIBROS,AUTORES,ESCRIBEN
            SET LIBROS.titulo=?,
            LIBROS.genero=?,
            LIBROS.pais=?,
            LIBROS.ano=?,
            LIBROS.numPaginas=?,
            ESCRIBEN.idPersona=?
            WHERE LIBROS.idLibro=?
            AND ESCRIBEN.idLibro=LIBROS.idLibro AND ESCRIBEN.idPersona=AUTORES.idPersona";


           $stmt = $this->conection->prepare($sql);

           $stmt->execute([$titulo, $genero, $pais, $ano, $paginas,$idPersona,$idLibro]);

            return $libro;
        }


        public function confirmarDelete($idLibro){

            $this->borrarIdEscriben($idLibro);

            $sql = "DELETE  FROM " . $this->tabla . " WHERE idLibro= ?";

            $stmt = $this->conection->prepare($sql);

         //  print_r($idLibro);

            $stmt->execute([$idLibro]);


            return $idLibro;
        }

        //BORRA EL LIBRO DE LA TABLA ESCRIBEN
        private function borrarIdEscriben($idLibro){

            $sql = "DELETE  FROM ESCRIBEN WHERE idLibro= ?";

            $stmt = $this->conection->prepare($sql);

            //print_r($idLibro);

            $stmt->execute([$idLibro]);
        }


        public function edit($param){

            $libro = $this->mostrarLibroId($param);
            $libro['autores'] =$this->objAutores->mostrarAutores();
            print_r($libro);
            return $libro;

        }

        public function insert($Post){

            $comprobacion=false;

            foreach ($_POST as $valor){

               // echo $valor."<br>";

                if(!is_array($valor)){

                    if(!empty(trim($valor)) && trim($valor)!=null){

                        $comprobacion=true;
                    }else{

                        $comprobacion=false;
                        break;
                    }
                }
            }
            if($comprobacion==true ){

                $sql = "INSERT INTO " . $this->tabla . " (titulo,genero,pais,ano,numPaginas) VALUES
                ('".$Post['nuevoTitulo']."','".$Post['nuevoGenero']."','".$Post['nuevoPais']."',
                '".(int)$Post['nuevoAno']."','".(int)$Post['nuevoPag']."')";

                $stmt = $this->conection->prepare($sql);

                $stmt->execute();
                //Recoge el ultimo id del ultimo libro insertado
                $ultimoIdLibro=$this->conection->lastInsertId();

                $arrAutores=$Post['autores'];

                foreach ($arrAutores as $autor){

                  $this->insertarAutoresEscriben($ultimoIdLibro,$autor);
                }

            }else{
                echo "Debes rellenar todos los campos";
            }

        }

        //INSERTA EN LA TABLA ESCRIBEN EL IDLIBRO Y IDPERSONA
        private function insertarAutoresEscriben($ultimoIdLibro,$autor){

            $sql = "INSERT INTO ESCRIBEN (idLibro,idPersona) VALUES ($ultimoIdLibro,$autor)";

            $stmt = $this->conection->prepare($sql);

            $stmt->execute();
        }


        //FUNCION PARA PILLAR EL VALOR MINIMO DE LA COLUMNA QUE LE PASAMOS
        private function getMinParam(string $nombreColumna){

            if($nombreColumna=='idPersona'){

                $sql = "SELECT MIN(".$nombreColumna.") AS MinColumna FROM AUTORES" ;
            }else{
                $sql = "SELECT MIN(".$nombreColumna.") AS MinColumna FROM " . $this->tabla ;
            }


          //  echo "EL sql: ".$sql;
            $stmt = $this->conection->prepare($sql);

            $stmt->execute();
            $filaMin=$stmt->fetch(PDO::FETCH_ASSOC);
            return $filaMin['MinColumna'];
        }
        //FUNCION PARA PILLAR EL VALOR MAXIMO DE LA COLUMNA QUE LE PASAMOS
        private function getMaxParam(string $nombreColumna){

            if($nombreColumna=='idPersona'){

                $sql = "SELECT MAX(".$nombreColumna.") AS MaxColumna FROM AUTORES" ;
            }else{
                $sql = "SELECT MAX(".$nombreColumna.") AS MaxColumna FROM " . $this->tabla ;
            }

            //  echo "EL sql: ".$sql;
            $stmt = $this->conection->prepare($sql);

            $stmt->execute();
            $filaMax=$stmt->fetch(PDO::FETCH_ASSOC);
            return $filaMax['MaxColumna'];
        }

        public function buscarLibros($post){

            $post['IdMin'] = (!empty($post['IdMin'])) ? $post['IdMin'] : $this->getMinParam('idLibro');
            $post['IdMax'] = (!empty($post['IdMax'])) ? $post['IdMax'] : $this->getMaxParam('idLibro');
            $post['Titulo']= "%".$post['Titulo']."%";
            $post['Genero']=  (!empty($post['Genero'])) ? $post['Genero'] : "%%";
            $post['Pais']=  (!empty($post['Pais'])) ? $post['Pais'] : "%%";
            $post['AnoMin'] = (!empty($post['AnoMin'])) ? $post['AnoMin'] : $this->getMinParam('ano');
            $post['AnoMax'] = (!empty($post['AnoMax'])) ? $post['AnoMax'] : $this->getMaxParam('ano');

            $post['MinPag'] = (!empty($post['MinPag'])) ? $post['MinPag'] : $this->getMinParam('numPaginas');
            $post['MaxPag'] = (!empty($post['MaxPag'])) ? $post['MaxPag'] : $this->getMaxParam('numPaginas');


            // CON UNA CONDICION O ALGO VIENDO LA LONGITUD DEL ARRAY PODRIA SABER SI SE PASA MAS DE UN AUTOR
            $post['Autor']=  (!empty($post['autores'])) ? " AND AUTORES.IDPERSONA = '".$post['autores'] ."'" : " AND AUTORES.IDPERSONA LIKE '%%'";




//            $sql = "SELECT *  FROM  LIBROS,AUTORES,ESCRIBEN WHERE
//
//                 LIBROS.IDLIBRO BETWEEN ".$post['IdMin']." AND ".$post['IdMax'].
//                " AND  LIBROS.TITULO LIKE '".$post['Titulo'].
//                "' AND LIBROS.GENERO LIKE '".$post['Genero'].
//                "' AND LIBROS.PAIS LIKE '".$post['Pais'].
//                "' AND LIBROS.ANO BETWEEN ".$post['AnoMin']." AND ".$post['AnoMax'].
//                " AND LIBROS.NUMPAGINAS BETWEEN ".$post['MinPag']." AND ".$post['MaxPag'].
//                $post['Autor'].
//                " AND ESCRIBEN.IDLIBRO = LIBROS.IDLIBRO AND ESCRIBEN.IDPERSONA=AUTORES.IDPERSONA";


            $sql = "SELECT * FROM LIBROS WHERE 
                 LIBROS.IDLIBRO BETWEEN ".$post['IdMin']." AND ".$post['IdMax'].
                "  AND  LIBROS.TITULO LIKE '".$post['Titulo'].
                "' AND LIBROS.GENERO LIKE '".$post['Genero'].
                "' AND LIBROS.PAIS LIKE '".$post['Pais'].
                "' AND LIBROS.ANO BETWEEN ".$post['AnoMin']." AND ".$post['AnoMax'].
                "  AND LIBROS.NUMPAGINAS BETWEEN ".$post['MinPag']." AND ".$post['MaxPag'];


            $stmt = $this->conection->prepare($sql);


            $stmt->execute();

            $libros=[];

            while($libro=$stmt->fetch(PDO::FETCH_ASSOC)) {


                $arrAutores=$this->mostrarAutoresId($libro);
                foreach ($arrAutores as $autor){

                    $libro['idPersona'][]=$autor['idPersona'];
                    $libro['nombreCompleto'][]=$autor['nombreCompleto'];
                }
                array_push($libros,$libro);
            }
           // echo $sql;

         //  return $stmt->fetchAll(PDO::FETCH_ASSOC);


           return $libros;

        }


        private function mostrarAutoresId($libro){
                $objAutor= new Autores();

                return $objAutor->mostrarAutoresPorId($libro['idLibro']);
        }
//    foreach ($arrAutores as $autor){
//
//        //Meto el [] para que en caso de que haya varios valores, no se sobreescriban
//    $libro['idPersona'][]=$autor['idPersona'];
//    $libro['nombreCompleto'][]=$autor['nombreCompleto'];
//    }


        public function buscarColumna($columna){

            $sql = "SELECT DISTINCT $columna FROM ". $this->tabla ;

            $stmt = $this->conection->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function buscarColumnaAutores(){

            $sql = "SELECT * FROM AUTORES";
            //echo $sql;
            $stmt = $this->conection->prepare($sql);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }


    }
