-- CREATE DATABASE mvc_biblioteca;
-- use mvc_biblioteca;
-- CREATE TABLE autores (
-- idPersona  int AUTO_INCREMENT primary key,
-- nombre  VARCHAR(20),
-- apellido VARCHAR(14) ) ;


-- CREATE TABLE usuario (
--  id  int AUTO_INCREMENT primary key,
--  email varchar(50) NOT NULL CHECK (email LIKE '%@gmail.com'),
--  contrasena varchar(20) NOT NULL);

-- CREATE TABLE libros (
--  idLibro int AUTO_INCREMENT  primary key,
--  titulo	VARCHAR(40),
--  genero	VARCHAR(15),
--  pais	VARCHAR(10),
--  ano 	integer(4),
--  numPaginas   integer(4)) ;
--
-- INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('Manolito Gafotas','infantil','España',1994,192);
-- INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('Crónicas de la Dragonlance','fantasía épica','USA',1987,1472);
-- INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('Matilda','falntasía','UK',1988, 248);
-- INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('El león, la bruja y el armario','fantasía','UK',1950,240);
-- INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('el hobbit','Fantasía heroica','UK',1937,288);
-- INSERT INTO libros (titulo,genero,pais,ano,numPaginas) VALUES ('Harry Potter y la piedra filosofal','fantasía','UK',1997,264);


-- create table escriben(
--  idLibro integer(3),
--  idPersona integer(2),
--  primary key(idLibro,idPersona),
--  constraint fk_escbiben_libros foreign key (idLibro) references libros(idLibro),
--  constraint fk_escbiben_autores foreign key (idPersona) references autores(idPersona)) ;

-- INSERT INTO usuario (email,contrasena) VALUES ('adrinetor81@gmail.com','1234');

--
-- INSERT INTO autores (nombre,apellido) VALUES ('Joanne','Rowling');
-- INSERT INTO autores (nombre,apellido) VALUES ('John Ronald Reuel','Tolkien');
-- INSERT INTO autores (nombre,apellido) VALUES ('Clive Staples','Lewis');
-- INSERT INTO autores (nombre,apellido) VALUES ('Roald','Dahl');
-- INSERT INTO autores (nombre,apellido) VALUES ('Marget','Weis');
-- INSERT INTO autores (nombre,apellido) VALUES ('Tracy','Hickman');
-- INSERT INTO autores (nombre,apellido) VALUES ('Elvira','Lindo');