﻿-- Script was generated by Devart dbForge Studio for MySQL, Version 4.50.285.0
-- Script date 07/05/2013 22:31:03
-- Server version: 5.5.24-log
-- Client version: 4.1

-- 
-- Disable foreign keys
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Set character set the client will use to send SQL statements to the server
--
SET NAMES 'utf8';

--
-- Definition for database intranet_ceti
--
DROP DATABASE IF EXISTS intranet_ceti;
CREATE DATABASE IF NOT EXISTS intranet_ceti
	CHARACTER SET latin1
	COLLATE latin1_swedish_ci;

-- 
-- Set default database
--
USE intranet_ceti;

--
-- Definition for table tbl_permission
--
CREATE TABLE IF NOT EXISTS tbl_permission (
  id_permission INT(4) NOT NULL AUTO_INCREMENT,
  key_permission VARCHAR(25) NOT NULL,
  name VARCHAR(60) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  PRIMARY KEY (id_permission),
  UNIQUE INDEX key_permission (key_permission)
)
ENGINE = INNODB
AUTO_INCREMENT = 14
AVG_ROW_LENGTH = 1489
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_role
--
CREATE TABLE IF NOT EXISTS tbl_role (
  id_role VARCHAR(255),
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_role)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_subject
--
CREATE TABLE IF NOT EXISTS tbl_subject (
  id_subject INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_subject)
)
ENGINE = INNODB
AUTO_INCREMENT = 9
AVG_ROW_LENGTH = 2048
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_role_permission
--
CREATE TABLE IF NOT EXISTS tbl_role_permission (
  id_role_permission INT(4) NOT NULL AUTO_INCREMENT,
  id_role VARCHAR(5) DEFAULT NULL,
  id_permission INT(11) DEFAULT NULL,
  PRIMARY KEY (id_role_permission),
  INDEX FK_tlb_role_permission_tbl_permission_id_permission (id_permission),
  INDEX FK_tlb_role_permission_tbl_role_id_role (id_role),
  CONSTRAINT FK_tlb_role_permission_tbl_permission_id_permission FOREIGN KEY (id_permission)
    REFERENCES tbl_permission(id_permission),
  CONSTRAINT FK_tlb_role_permission_tbl_role_id_role FOREIGN KEY (id_role)
    REFERENCES tbl_role(id_role)
)
ENGINE = INNODB
AUTO_INCREMENT = 14
AVG_ROW_LENGTH = 3276
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_subject_registration
--
CREATE TABLE IF NOT EXISTS tbl_subject_registration (
  id_subject_registration INT(11) NOT NULL AUTO_INCREMENT,
  id_subject INT(4) DEFAULT NULL,
  year_section INT(1) DEFAULT NULL,
  PRIMARY KEY (id_subject_registration),
  INDEX FK_tbl_subject_registration_tbl_subject_id_subject (id_subject),
  CONSTRAINT FK_tbl_subject_registration_tbl_subject_id_subject FOREIGN KEY (id_subject)
    REFERENCES tbl_subject(id_subject)
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 5461
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_users
--
CREATE TABLE IF NOT EXISTS tbl_users (
  id_user INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  id_role VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_user),
  INDEX FK_tbl_user_tbl_role_id_role (id_role),
  CONSTRAINT FK_tbl_user_tbl_role_id_role FOREIGN KEY (id_role)
    REFERENCES tbl_role(id_role)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 5461
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_person
--
CREATE TABLE IF NOT EXISTS tbl_person (
  id_person INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(60) DEFAULT NULL,
  lastname VARCHAR(60) DEFAULT NULL,
  address VARCHAR(100) DEFAULT NULL,
  phone VARCHAR(10) DEFAULT NULL,
  cellphone VARCHAR(11) DEFAULT NULL,
  dni VARCHAR(8) DEFAULT NULL,
  sex VARCHAR(15) DEFAULT NULL,
  `e-mail` VARCHAR(30) DEFAULT NULL,
  born VARCHAR(20) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id_person),
  UNIQUE INDEX id_user (id_user),
  CONSTRAINT FK_tbl_person_tbl_users_id_user FOREIGN KEY (id_user)
    REFERENCES tbl_users(id_user)
)
ENGINE = INNODB
AUTO_INCREMENT = 7
AVG_ROW_LENGTH = 3276
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_alumn
--
CREATE TABLE IF NOT EXISTS tbl_alumn (
  id_alumn INT(11) NOT NULL AUTO_INCREMENT,
  id_person INT(11) DEFAULT NULL,
  `condition` VARCHAR(3) DEFAULT NULL,
  PRIMARY KEY (id_alumn),
  UNIQUE INDEX id_person (id_person),
  CONSTRAINT FK_tbl_alumn_tbl_person_id_person FOREIGN KEY (id_person)
    REFERENCES tbl_person(id_person)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_docente
--
CREATE TABLE IF NOT EXISTS tbl_docente (
  id_docente INT(4) NOT NULL AUTO_INCREMENT,
  id_person INT(11) DEFAULT NULL,
  PRIMARY KEY (id_docente),
  UNIQUE INDEX id_persona (id_person),
  CONSTRAINT FK_tbl_docente_tbl_person_id_person FOREIGN KEY (id_person)
    REFERENCES tbl_person(id_person)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_registration
--
CREATE TABLE IF NOT EXISTS tbl_registration (
  id_registration INT(11) NOT NULL,
  id_alumno INT(11) DEFAULT NULL,
  id_docente INT(4) DEFAULT NULL,
  year_secton VARCHAR(5) DEFAULT NULL,
  `year` INT(4) DEFAULT NULL,
  PRIMARY KEY (id_registration),
  INDEX FK_tbl_registration_tbl_alumn_id_alumn (id_alumno),
  INDEX FK_tbl_registration_tbl_docente_id_docente (id_docente),
  UNIQUE INDEX year_secton (year_secton),
  CONSTRAINT FK_tbl_registration_tbl_alumn_id_alumn FOREIGN KEY (id_alumno)
    REFERENCES tbl_alumn(id_alumn),
  CONSTRAINT FK_tbl_saloon_tbl_docente_id_docente FOREIGN KEY (id_docente)
    REFERENCES tbl_docente(id_docente)
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_record
--
CREATE TABLE IF NOT EXISTS tbl_record (
  id_bimester INT(11) NOT NULL AUTO_INCREMENT,
  id_subject INT(3) DEFAULT NULL,
  N1_average DOUBLE DEFAULT NULL,
  N2_average DOUBLE DEFAULT NULL,
  N3_average DOUBLE DEFAULT NULL,
  N4_average DOUBLE DEFAULT NULL,
  id_registration INT(11) DEFAULT NULL,
  PRIMARY KEY (id_bimester),
  INDEX FK_tbl_bimester_tbl_subject_id_subject (id_subject),
  INDEX FK_tbl_record_tbl_registration_id_registration (id_registration),
  CONSTRAINT FK_tbl_record_tbl_registration_id_registration FOREIGN KEY (id_registration)
    REFERENCES tbl_registration(id_registration)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

-- 
-- Dumping data for table tbl_permission
--
INSERT INTO tbl_permission VALUES 
  (3, 'add_alumn', 'Agregar Alumno', 'Registrar nuevo Alumno'),
  (4, 'add_docente', 'Agregar Docente', 'Registrar nuevo Docente'),
  (5, 'editAlumn', 'Editar Alumno', 'editAlumn'),
  (6, 'editDocente', 'Editar Docente', NULL),
  (7, 'elimAlumn', 'Eliminar Alumno', NULL),
  (8, 'elimDocente', 'Eliminar Docente', NULL),
  (9, 'asignarAlumn', 'Asignar Alumn', NULL),
  (10, 'asignarDocente', 'Asignar Docente', NULL),
  (11, 'aperturarAno', 'Aperturar Año', 'Apertura de nuevo año acedmico'),
  (12, 'gestion_curso', 'Gestionar Cursos', 'Asignar los cursos que se llevaran a cabo para cada año de la secundaria'),
  (13, 'abm_alumno', 'Gestionar Alumno', 'Gestión ABM de alumnos');

-- 
-- Dumping data for table tbl_role
--
INSERT INTO tbl_role VALUES 
  ('dir', 'Director'),
  ('doc', 'Docente');

-- 
-- Dumping data for table tbl_subject
--
INSERT INTO tbl_subject VALUES 
  (1, 'Persona Familia y Relaciones Humanas'),
  (2, 'Ciencias Sociales'),
  (3, 'Matemática'),
  (4, 'CTA'),
  (5, 'Ed. Fisica'),
  (6, 'Ed. Religiosa'),
  (7, 'Ed. Cívica'),
  (8, 'Lengua y Comunicación');

-- 
-- Dumping data for table tbl_role_permission
--
INSERT INTO tbl_role_permission VALUES 
  (3, 'dir', 3),
  (4, 'dir', 4),
  (11, 'dir', 11),
  (12, 'dir', 12),
  (13, 'dir', 13);

-- 
-- Dumping data for table tbl_subject_registration
--
INSERT INTO tbl_subject_registration VALUES 
  (1, 2, 4),
  (5, 4, 4),
  (6, 4, 5);

-- 
-- Dumping data for table tbl_users
--
INSERT INTO tbl_users VALUES 
  (1, 'delmonxd@gmail.com', 'holi', 'dir'),
  (3, 'cmandamiento', '1234', 'dir'),
  (5, 'javi@bicho.com', 'h0fbppsb', 'doc');

-- 
-- Dumping data for table tbl_person
--
INSERT INTO tbl_person VALUES 
  (1, 'Martín Antonio', 'Eguizabal Pichilingue', 'Coperativa Ingenio S/N', '-', '966479762', '71088598', 'M', 'martianep19@gmail.com', '20-11-1992', NULL),
  (2, 'Flavio Magyver', 'Figueroa Villarreal', 'AAHH Manzanares Et. 4 D-10', '-', '985037996', '71998024', 'M', 'magyverfigueroa@gmail.com', '09-03-1993', NULL),
  (3, 'César Oswaldo', 'Mandamiento Salas', 'Av. Centenario #1177', '012392255', '980312797', '72271819', 'M', 'delmonxd@gmail.com', '19-07-1993', NULL),
  (5, 'Carlos Antonio', 'Figueroa Pichilingue', 'Av. Los sauces #4477', '-', '987123456', '14723519', 'M', 'carlos@gmail.com', '10/06/1980', NULL),
  (6, 'Javier', 'Torres', 'Av. La paz 147', '-', '9741123854', '14785214', 'M', 'javi@bicho.com', '07-02-1984', NULL);

-- 
-- Dumping data for table tbl_alumn
--
INSERT INTO tbl_alumn VALUES 
  (1, 1, 'H'),
  (2, 2, 'H'),
  (3, 3, 'H');

-- 
-- Dumping data for table tbl_docente
--
INSERT INTO tbl_docente VALUES 
  (1, 5),
  (2, 6);

-- 
-- Dumping data for table tbl_registration
--
-- Table does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_record
--
-- Table does not contain any data (it is empty)

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;