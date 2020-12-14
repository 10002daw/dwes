DROP DATABASE IF EXISTS instituto;
CREATE DATABASE instituto DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
CREATE USER IF NOT EXISTS 'instituto'@'localhost' IDENTIFIED BY 'instituto2020';
GRANT ALL ON instituto.* TO 'instituto'@'localhost';

use instituto;

CREATE TABLE alumnos (
    id INT(6) AUTO_INCREMENT,
    nombre VARCHAR(40) not null,
    ap1 VARCHAR(35) not null,
    ap2 VARCHAR(35) null,
    nota DECIMAL(5,2),
    PRIMARY KEY(id)
) ENGINE=InnoDB;
INSERT INTO alumnos VALUES
(1,'Antonia','López','Fernández',4.5),
(2,'María','Pérez','López',8.5),
(3,'Antonio','García','Martínez',3.5),
(4,'Luisa','Fernández','García',7.5),
(5,'Felipez','Gutiérrez','Rodríguez',6.5),
(6,'Manuel','Hernández','López',5.5),
(7,'Felisa','Martín','Juárez',9.5),
(8,'Pedro','Martí','Ferrer',3.75),
(9,'Juana','López','López',10),
(10,'Fernando','García','Álvarez',4.5);


