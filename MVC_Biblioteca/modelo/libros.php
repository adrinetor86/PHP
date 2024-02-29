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

        public function siguientePagina($intPagina){

                $sql = "SELECT count(*) as totalPaginas FROM " . $this->tabla;


                $stmt = $this->conection->prepare($sql);
                $stmt->execute();

            $cantidad= $stmt->fetchAll(PDO::FETCH_ASSOC)[0]['totalPaginas'];

            $_SESSION['maxPage']= ceil($cantidad/DEFAULT_NOTES);

            if($cantidad>$intPagina*DEFAULT_NOTES){

                return true;
            }else{
                return false;
            }

           //1-1 *3=0
          //2-1 *3=3
         //3-1 *3=6

        }

  //  $sql= "SELECT *  FROM ".$this->tabla." LIMIT $indiceLibros, $librosMostrados";


        public function mostrarLibros($intPagina){

          //  $sql = 'SELECT * FROM ' . $this->tabla;

                        //PILLO EL NUMERO DE PAGINA, LE RESTO 1 Y LO MULTIPLICO POR EL NUMERO DE LIBROS QUE QUIERO MOSTRAR
            $indiceLibro= (($intPagina-1)*DEFAULT_NOTES);

         $sql  = ' SELECT idLibro,titulo,genero,pais,ano,numPaginas from libros LIMIT '. $indiceLibro.",". DEFAULT_NOTES ;
                echo $sql;
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
            $idSaga=$libro['Saga'];
         print_r($libro);
            echo "PAGINAS: " . $paginas;

            $sql= "UPDATE LIBROS,AUTORES,ESCRIBEN,SAGAS
            SET LIBROS.titulo=?,
            LIBROS.genero=?,
            LIBROS.pais=?,
            LIBROS.ano=?,
            LIBROS.numPaginas=?,
            ESCRIBEN.idPersona=?,
            RelacionSaga.iSaga=?
            WHERE LIBROS.idLibro=?
            AND ESCRIBEN.idLibro=LIBROS.idLibro AND ESCRIBEN.idPersona=AUTORES.idPersona";


                echo $sql;
           $stmt = $this->conection->prepare($sql);

           $stmt->execute([$titulo, $genero, $pais, $ano, $paginas,$idPersona,$idSaga,$idLibro]);

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
            $libro['sagas'] =$this->mostrarSagas();
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


                // AUTOR TIENE EL VALOR DEL ID
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

         //   print_r($post['autores']);



            if(!empty($post['autores'])) {
                $consultaAutores = " AUTORES.IDPERSONA ='" . $post['autores'][0] . "'";

                if (count($post['autores']) > 1) {

                    foreach ($post['autores'] as $idAutor) {
                        $consultaAutores .= " OR AUTORES.IDPERSONA='" . $idAutor . "'";

                    }
                }
                echo $consultaAutores;
            }
                $post['autores'] = (!empty($post['autores'])) ? " $consultaAutores " : " AUTORES.IDPERSONA LIKE '%%'";

                //  $post['autores']="AND AUTORES.IDPERSONA LIKE '%%'";

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


            $sql = "SELECT * FROM LIBROS,ESCRIBEN,AUTORES WHERE 
                 LIBROS.IDLIBRO BETWEEN ".$post['IdMin']." AND ".$post['IdMax'].
                "  AND LIBROS.TITULO LIKE '".$post['Titulo'].
                "' AND LIBROS.GENERO LIKE '".$post['Genero'].
                "' AND LIBROS.PAIS LIKE '".$post['Pais'].
                "' AND LIBROS.ANO BETWEEN ".$post['AnoMin']." AND ".$post['AnoMax'].
                "  AND LIBROS.NUMPAGINAS BETWEEN ".$post['MinPag']." AND ".$post['MaxPag'].

                " AND (".$post['autores'].')'.
                " AND ESCRIBEN.IDLIBRO = LIBROS.IDLIBRO AND ESCRIBEN.IDPERSONA=AUTORES.IDPERSONA";


        //echo $sql;
            $stmt = $this->conection->prepare($sql);

            $stmt->execute();

            $libros=[];
            $i=0;
            while($libro=$stmt->fetch(PDO::FETCH_ASSOC)) {

                $arrAutores=$this->mostrarAutoresId($libro);

                  //  echo "ARR AUTORES:<BR>";

                echo "<br>";
//echo "<br>****";print_r($libro);echo "****<br>";
   unset($libro['idPersona']);



                foreach ($arrAutores as $autor){

                        $libro['idPersona'][]=$autor['idPersona'];
                        $libro['nombreCompleto'][]=$autor['nombreCompleto'];

                }
                $i++;
//                if(count($libro['nombreCompleto'])>1){
//                    echo "ENTRO";
//                    $libros[0]=$libro;
//                }else{

                    array_push($libros,$libro);

//echo "<br>****";print_r($libro);echo "****<br>";
//                echo "<br>LIBRO<br>";
//                print_r($libro);

            }
            echo "<br>LIBROS<br>";

            print_r($libros);
         // print_r($libros);
           // echo $sql;

           return $libros;
        }

        private function mostrarAutoresId($libro){
                $objAutor= new Autores();

               // print_r($libro);
                return $objAutor->mostrarAutoresPorId($libro['idLibro']);
        }
//    foreach ($arrAutores as $autor){
//
//        //Meto  [] para que en caso de que haya varios valores, no se sobreescriban
////    $libro['idPersona'][]=$autor['idPersona'];
////    $libro['nombreCompleto'][]=$autor['nombreCompleto'];el
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


        //PRUEBAS SAGAS

    public function mostrarSagas(){

        $sql = "SELECT distinct nombreSaga FROM sagas ";

        $stmt = $this->conection->prepare($sql);

        $stmt->execute();

        $libros=[];
        while($saga=$stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "*****";
            //    print_r($saga);

            $arrSagasLibros = $this->mostrarLibrosSagas($saga['nombreSaga']);

            foreach ($arrSagasLibros as $libro) {
                $saga['idLibro'][] = $libro['idLibro'];
                $saga['titulo'][] = $libro['titulo'];

            };



            array_push($libros, $saga);
        }




        return $libros;

      //  return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function mostrarLibrosSagas($nombreSaga){

        $sql = "SELECT * FROM libros,sagas WHERE libros.idLibro=sagas.idSaga and sagas.nombreSaga='".$nombreSaga."'";
       echo $sql;
        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarIDSaga($nombreSaga){

        $sql = "SELECT idSaga FROM sagas where nombreSaga='".$nombreSaga."'";
        //echo $sql;
        $stmt = $this->conection->prepare($sql);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function insertarIDRelSaga($idLibro,$idSaga){

            $sql = "INSERT INTO relacionSaga  VALUES ($idLibro,$idSaga)";
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
    }

    public function insertarSaga($idSaga){

            $sql = "INSERT INTO sagas (nombreSaga) VALUES ('$idSaga')";
    //echo $sql;
       // INSERT INTO sagas (nombreSaga) VALUES ('Geronimo Stilton');
            $stmt = $this->conection->prepare($sql);
            $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function listarSagas(){

        $sql = "SELECT * FROM sagas order by idSaga";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarLibrosSagas()
    {

        $sql = "SELECT * FROM libros order by idSaga";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        }
    }
