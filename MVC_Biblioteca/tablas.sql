-- CREATE DATABASE mvc_biblioteca;
-- use mvc_biblioteca;

CREATE TABLE autores (
idPersona  int AUTO_INCREMENT primary key,
nombre  VARCHAR(20),
apellido VARCHAR(14) ) ;



CREATE TABLE usuario (
 id  int AUTO_INCREMENT primary key,
 email varchar(50) NOT NULL CHECK (email LIKE '%@gmail.com'),
 contrasena varchar(20) NOT NULL);



CREATE TABLE libros (
 idLibro int AUTO_INCREMENT  primary key,
 titulo	VARCHAR(40),
 genero	VARCHAR(15),
 pais	VARCHAR(10),
 ano 	integer(4),
 numPaginas   integer(4)
 idSaga integer(3)

 foreign key (idSaga) references sagas(idSaga));





INSERT INTO autores (nombre,apellido) VALUES ('Elvira','Lindo');
INSERT INTO autores (nombre,apellido) VALUES ('Marget','Weis');
INSERT INTO autores (nombre,apellido) VALUES ('Roald','Dahl');
INSERT INTO autores (nombre,apellido) VALUES ('Clive Staples','Lewis');
INSERT INTO autores (nombre,apellido) VALUES ('John Ronald Reuel','Tolkien');
INSERT INTO autores (nombre,apellido) VALUES ('Joanne','Rowling');


create table escriben(
 idLibro integer(3),
 idPersona integer(3),
 primary key(idLibro,idPersona),
 constraint fk_escbiben_libros foreign key (idLibro) references libros(idLibro),
 constraint fk_escbiben_autores foreign key (idPersona) references autores(idPersona)) ;


--
-- create table relacionSaga(
--   idLibro integer(3),
--   idSaga integer(3),
--   primary key(idLibro,idSaga),
--   constraint fk_escbiben_libros foreign key (idLibro) references libros(idLibro),
--   constraint fk_escbiben_sagas foreign key (idSaga) references sagas(idSaga)
--   );

CREATE TABLE sagas(
    idSaga     int AUTO_INCREMENT primary key,
    nombreSaga VARCHAR(40),

);



-- INSERT INTO usuario (email,contrasena) VALUES ('adrinetor81@gmail.com','1234');

--
INSERT INTO autores (nombre,apellido) VALUES ('Joanne','Rowling');
INSERT INTO autores (nombre,apellido) VALUES ('John Ronald Reuel','Tolkien');
INSERT INTO autores (nombre,apellido) VALUES ('Clive Staples','Lewis');
INSERT INTO autores (nombre,apellido) VALUES ('Roald','Dahl');
INSERT INTO autores (nombre,apellido) VALUES ('Marget','Weis');
INSERT INTO autores (nombre,apellido) VALUES ('Tracy','Hickman');
INSERT INTO autores (nombre,apellido) VALUES ('Elvira','Lindo');


-- SELECT escriben.idLibro,titulo,genero,pais,ano,numPaginas,escriben.idPersona,nombre,apellido
-- from libros,escriben,autores where escriben.idLibro = libros.idLibro and escriben.idPersona=autores.idPersona;


drop TABLE escriben;

TRUNCATE autores;

TRUNCATE libros;

create table escriben(
  idLibro integer(3),
  idPersona integer(3),
  primary key(idLibro,idPersona),
  constraint fk_escbiben_libros foreign key (idLibro) references libros(idLibro),
  constraint fk_escbiben_autores foreign key (idPersona) references autores(idPersona)) ;



INSERT INTO libros (titulo,genero,pais,ano,numPaginas,idSaga) VALUES ('Manolito Gafotas','infantil','España',1994,192,1);
INSERT INTO libros (titulo,genero,pais,ano,numPaginas,idSaga) VALUES ('Crónicas de la Dragonlance','fantasía épica','USA',1987,1472,1);
INSERT INTO libros (titulo,genero,pais,ano,numPaginas,idSaga) VALUES ('Matilda','falntasía','UK',1988, 248,2);
INSERT INTO libros (titulo,genero,pais,ano,numPaginas,idSaga) VALUES ('El león, la bruja y el armario','fantasía','UK',1950,240,2);
INSERT INTO libros (titulo,genero,pais,ano,numPaginas,idSaga) VALUES ('El hobbit','Fantasía heroica','UK',1937,288,2);
INSERT INTO libros (titulo,genero,pais,ano,numPaginas,idSaga) VALUES ('Harry Potter y la piedra filosofal','fantasía','UK',1997,264,3);


INSERT INTO autores (nombre,apellido) VALUES ('Elvira','Lindo');
INSERT INTO autores (nombre,apellido) VALUES ('Marget','Weis');
INSERT INTO autores (nombre,apellido) VALUES ('Roald','Dahl');
INSERT INTO autores (nombre,apellido) VALUES ('Clive Staples','Lewis');
INSERT INTO autores (nombre,apellido) VALUES ('John Ronald Reuel','Tolkien');
INSERT INTO autores (nombre,apellido) VALUES ('Joanne','Rowling');


insert INTO escriben VALUES(1,1);
insert INTO escriben VALUES(2,2);
insert INTO escriben VALUES(3,3);
insert INTO escriben VALUES(4,4);
insert INTO escriben VALUES(5,5);
insert INTO escriben VALUES(6,6);



INSERT INTO sagas (nombreSaga) VALUES ('Señor de los Anillos');
INSERT INTO sagas (nombreSaga) VALUES ('Geronimo Stilton');
INSERT INTO sagas (nombreSaga) VALUES ('Saw');

UPDATE LIBROS,AUTORES,ESCRIBEN
SET LIBROS.titulo='Manolito Gafotas',
    LIBROS.genero='infantil',
    LIBROS.pais='España',
    LIBROS.ano=1994,
    LIBROS.numPaginas=196,
    ESCRIBEN.idPersona=3
WHERE libros.idLibro=1
  AND ESCRIBEN.idLibro=LIBROS.idLibro AND ESCRIBEN.idPersona=AUTORES.idPersona;



INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('Jacintock','terror','Inglaterra',1997,191);

INSERT INTO autores (nombre,apellido) VALUES ('Adrian','Jacek');

insert INTO escriben VALUES(7,3);










select * from libros,autores,escriben,relacionsaga,sagas
WHERE libros.idLibro = escriben.idLibro and escriben.idPersona= autores.idPersona
  and sagas.idSaga = relacionsaga.idSaga and relacionsaga.idLibro =libros.idLibro







$sql = "SELECT * FROM LIBROS,ESCRIBEN,AUTORES WHERE
                 LIBROS.IDLIBRO BETWEEN ".$post['IdMin']." AND ".$post['IdMax'].
                "  AND  LIBROS.TITULO LIKE '".$post['Titulo'].
                "' AND LIBROS.GENERO LIKE '".$post['Genero'].
                "' AND LIBROS.PAIS LIKE '".$post['Pais'].
                "' AND LIBROS.ANO BETWEEN ".$post['AnoMin']." AND ".$post['AnoMax'].
                "  AND LIBROS.NUMPAGINAS BETWEEN ".$post['MinPag']." AND ".$post['MaxPag'];

