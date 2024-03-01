create database biblioteca;
use biblioteca2;    
CREATE TABLE autores (
 idPersona  integer(2) primary key,
 nombre  VARCHAR(20), 
 apellido      VARCHAR(14) ) ;

INSERT INTO autores VALUES (10,'Joanne','Rowling');
INSERT INTO autores VALUES (20,'John Ronald Reuel','Tolkien');
INSERT INTO autores VALUES (30,'Clive Staples','Lewis');
INSERT INTO autores VALUES (40,'Roald','Dahl');
INSERT INTO autores VALUES (50,'Marget','Weis');
INSERT INTO autores VALUES (60,'Tracy','Hickman');
INSERT INTO autores VALUES (70,'Elvira','Lindo');

CREATE TABLE libros (
 idLibro integer(3)  primary key,
 titulo	VARCHAR(40),
 genero	VARCHAR(15),
 pais	VARCHAR(10),
 ano 	integer(4),
 numPaginas   integer(4)) ;

INSERT INTO libros VALUES (10,'Manolito Gafotas','infantil','España',1994,192);
INSERT INTO libros VALUES (20,'Crónicas de la Dragonlance','fantasía épica','USA',1987,1472);
INSERT INTO libros VALUES (30,'Matilda','falntasía','UK',1988, 248);
INSERT INTO libros VALUES (40,'El león, la bruja y el armario','fantasía','UK',1950,240);
INSERT INTO libros VALUES (50,'el hobbit','Fantasía heroica','UK',1937,288);
INSERT INTO libros VALUES (60,'Harry Potter y la piedra filosofal','fantasía','UK',1997,264);

create table escriben(
   idLibro integer(3),
   idPersona integer(2),
   primary key(idLibro,idPersona),
   constraint fk_escbiben_libros foreign key (idLibro) references libros(idLibro),
   constraint fk_escbiben_autores foreign key (idPersona) references autores(idPersona)) ;
 
insert into escriben VALUES (10,70);
insert into escriben VALUES (20,60);
insert into escriben VALUES (20,50);
insert into escriben VALUES (30,40);
insert into escriben VALUES (40,30);
insert into escriben VALUES (50,20);
insert into escriben VALUES (60,10);

CREATE TABLE usuarios (
 id         integer(2) primary key,
 email      VARCHAR(20), 
 password   VARCHAR(10));

INSERT INTO usuarios VALUES (10,'pepe@gmail.com','1234');
INSERT INTO usuarios VALUES (20,'maria@gmail.com','5678');
INSERT INTO usuarios VALUES (30,'raul@gmail.com','1298');
INSERT INTO usuarios VALUES (40,'ana@gmail.com','4321');

CREATE TABLE comentarios (
   id INT AUTO_INCREMENT PRIMARY KEY, 
   idPersona INT(2) NOT NULL , 
   idLibro INT(3) NOT NULL , 
   nota INT(2) NOT NULL , 
   comentario TEXT NOT NULL ,  
   constraint fk_comentario_usuario foreign key (idPersona) references usuarios(id),
   constraint fk_comentario_libro foreign key (idLibro) references libros(idLibro));

INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (10, 10, 80,'Libro muy divertido, típico español');
INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (10, 50, 80,'Precuela del señor de los anillos. Imprescindible su lectura');
INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (10, 60, 60,'Mejoran los siguientes, pero este no es demasiado bueno');
INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (20, 10, 75,'Para pasar un buen rato');
INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (20, 30, 70,'Novela de ficción interesante');
INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (30, 10, 80,'De los mejores libros infantiles que he leido');
INSERT INTO comentarios(idPersona, idLibro, nota, comentario) VALUES (40, 20, 80,'Trilogía muy recomendable. De lo mejor en fantasía épica');


grant all privileges on biblioteca2 to pepe;

-- consultas
--mostrar todos los libros
SELECT idLibro, titulo, genero, pais, ano, numPaginas FROM libros order by idLibro
-- cantidad de libros con un código y su nota media de un determinado libro
SELECT count(*) cantidad, avg(nota) media FROM comentarios where idLibro=10;
-- mostrar email, comentario y nota de un determinado libro
SELECT email, comentario, nota FROM comentarios c, usuarios u where c.idPersona=u.id and idLibro=10; 
