
database lacasadepapel;

CREATE TABLE personajes(
   id     int AUTO_INCREMENT Primary key,
   nombre varchar(30) ,
   apodo  varchar(30),
   genero varchar(20),
   edad   int

);



INSERT INTO personajes (nombre, apodo, genero, edad) VALUES
  ('Álvaro Morte', 'El Profesor', 'Masculino', 46),
  ('Itziar Ituño', 'Raquel Murillo', 'Femenino', 47),
  ('Pedro Alonso', 'Berlín', 'Masculino', 49),
  ('Miguel Herrán', 'Río', 'Masculino', 25),
  ('Jaime Lorente', 'Denver', 'Masculino', 29),
  ('Esther Acebo', 'Mónica Gaztambide', 'Femenino', 38),
  ('Darko Perić', 'Helsinki', 'Masculino', 44),
  ('Úrsula Corberó', 'Tokio', 'Femenino', 31),
  ('Enrique Arce', 'Arturo Román', 'Masculino', 48),
  ('Alba Flores', 'Nairobi', 'Femenino', 34);

