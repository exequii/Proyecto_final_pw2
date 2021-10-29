use pw2;

CREATE TABLE usuario (idusuario SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
					  usuario VARCHAR(30) NOT NULL,
                      rol VARCHAR(15) NOT NULL DEFAULT "USUARIO",
                      clave VARCHAR(30) NOT NULL,
                        hash VARCHAR(32));


INSERT INTO usuario (usuario, clave, rol) VALUES ("admin@admin.com","admin","ADMIN");

SELECT * FROM usuario;

CREATE TABLE hospital (idhospital SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                        nombre VARCHAR(30) NOT NULL,
                        capacidad SMALLINT);

CREATE TABLE turno (idturno SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    usuario_id SMALLINT NOT NULL,
                    hospital_id SMALLINT(30) NOT NULL,
                    dia DATE NOT NULL,
                    FOREIGN KEY (usuario_id) REFERENCES usuario(idusuario),
                    FOREIGN KEY (hospital_id) REFERENCES hospital(idhospital));

INSERT INTO `hospital` (`idhospital`, `nombre`, `capacidad`)
                        VALUES (NULL, 'Buenos Aires', '300'),
                               (NULL, 'Shanghái', '210'),
                               (NULL, 'Ankara', '200');

ALTER TABLE `usuario` ADD `nivelVuelo` TINYINT NULL ;

CREATE TABLE equipo (idequipo SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                       tipo VARCHAR(30) NOT NULL,
                       modelo VARCHAR(30) NOT NULL,
                       capacidad INT);

CREATE TABLE vuelo (idvuelo SMALLINT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    dia VARCHAR(30) NOT NULL,
                    equipo_id SMALLINT NOT NULL,
                    duracion SMALLINT,
                    partida VARCHAR(15) NOT NULL,
                    horario TIME NOT NULL ,
                    FOREIGN KEY (equipo_id) REFERENCES equipo(idequipo));

INSERT INTO `equipo` (`idequipo`, `tipo`, `modelo`, `capacidad`)
                    VALUES (NULL, 'orbital', 'calandria', '300'),
                           (NULL, 'orbital', 'colibri', '120');

INSERT INTO `vuelo` (`idvuelo`, `dia`, `equipo_id`, `duracion`, `partida`, `horario`)
                    VALUES (NULL, 'lunes', '1', '8', 'BA', '08:00');