
database lacasadepapel;


         drop table personajes;

CREATE TABLE imagenes_personajes(
    id     int AUTO_INCREMENT Primary key,
    imagen varchar(300)
    );


CREATE TABLE personajes(
   id     int AUTO_INCREMENT Primary key,
   nombre varchar(30) ,
   apodo  varchar(30),
   genero varchar(20),
   edad   int,
   imagenId int

foreign key (imagenId) references imagenes_personajes(id);
);

INSERT INTO imagenes_personajes (imagen) VALUES
    ('https://upload.wikimedia.org/wikipedia/commons/thumb/d/dc/%C3%81lvaro_Morte%2C_2020_%28cropped%29.jpg/800px-%C3%81lvaro_Morte%2C_2020_%28cropped%29.jpg'),
    ('https://upload.wikimedia.org/wikipedia/commons/4/41/Itziar_Itu%C3%B1o_2018_%28cropped%29.jpg'),
    ('https://imagenes.20minutos.es/files/image_1920_1080/uploads/imagenes/2023/12/15/pedro-alonso-en-berlin.jpeg'),
    ('https://es.web.img3.acsta.net/pictures/18/09/27/17/35/5121683.jpg'),
    ('https://upload.wikimedia.org/wikipedia/commons/e/ec/Premios_Goya_2020_-_Jaime_Lorente_%28cropped%29.jpg'),
    ('https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/Esther_Acebo.jpg/800px-Esther_Acebo.jpg'),
    ('https://elcomercio.pe/resizer/12EGeJUF1Hh2vx0o80FM692wrTc=/1200x900/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/BXYJTIE7IJDH7LG4LBGJX6VLRA.jpg'),
    ('https://content.semana.es/medio/2020/12/ursula-corbero-destacada.jpg'),
    ('https://www.esferalibros.com/wp-content/uploads/2021/04/principal-enrique-arce-es.jpg'),
    ('https://media.vogue.es/photos/5ec35abce1abec772f22f233/2:3/w_2560%2Cc_limit/GettyImages-1188504001.jpg');

INSERT INTO personajes (nombre, apodo, genero, edad,imagenId) VALUES
 ('Álvaro Morte', 'El Profesor', 'Masculino', 46,1),
 ('Itziar Ituño', 'Raquel Murillo', 'Femenino', 47,2),
 ('Pedro Alonso', 'Berlín', 'Masculino', 49,3),
 ('Miguel Herrán', 'Río', 'Masculino', 25,4),
 ('Jaime Lorente', 'Denver', 'Masculino', 29,5),
 ('Esther Acebo', 'Mónica Gaztambide', 'Femenino', 38,6),
 ('Darko Perić', 'Helsinki', 'Masculino', 44,7),
 ('Úrsula Corberó', 'Tokio', 'Femenino', 31,8),
 ('Enrique Arce', 'Arturo Román', 'Masculino', 48,9),
 ('Alba Flores', 'Nairobi', 'Femenino', 34,10);


