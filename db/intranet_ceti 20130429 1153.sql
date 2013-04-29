﻿-- Script was generated by Devart dbForge Studio for MySQL, Version 4.50.285.0
-- Script date 29/04/2013 11:53:59
-- Server version: 5.5.20-log
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
-- Definition for table tbl_alumn
--
CREATE TABLE IF NOT EXISTS tbl_alumn (
  id_alumn INT(11) NOT NULL AUTO_INCREMENT,
  id_person INT(11) DEFAULT NULL,
  grade VARCHAR(1) DEFAULT NULL,
  section VARCHAR(255) DEFAULT NULL,
  `condition` VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY (id_alumn),
  UNIQUE INDEX id_person (id_person)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_course
--
CREATE TABLE IF NOT EXISTS tbl_course (
  id_course VARCHAR(255),
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_course)
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_docente
--
CREATE TABLE IF NOT EXISTS tbl_docente (
  id_docente INT(11) NOT NULL AUTO_INCREMENT,
  id_curso VARCHAR(255) DEFAULT NULL,
  id_persona INT(11) DEFAULT NULL,
  PRIMARY KEY (id_docente),
  UNIQUE INDEX id_persona (id_persona)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_permission
--
CREATE TABLE IF NOT EXISTS tbl_permission (
  id_permission INT(11) NOT NULL AUTO_INCREMENT,
  key_permission VARCHAR(255) NOT NULL,
  name VARCHAR(255) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  valor TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (id_permission),
  UNIQUE INDEX key_permission (key_permission)
)
ENGINE = INNODB
AUTO_INCREMENT = 12
AVG_ROW_LENGTH = 1820
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
AVG_ROW_LENGTH = 16384
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
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_year
--
CREATE TABLE IF NOT EXISTS tbl_year (
  id_year_achademic INT(11) NOT NULL AUTO_INCREMENT,
  `year` INT(11) DEFAULT NULL,
  `condition` VARCHAR(5) DEFAULT 'N',
  PRIMARY KEY (id_year_achademic)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_bimester
--
CREATE TABLE IF NOT EXISTS tbl_bimester (
  id_bimester INT(11) NOT NULL AUTO_INCREMENT,
  id_alumno INT(11) DEFAULT NULL,
  id_subject INT(3) DEFAULT NULL,
  bimester VARCHAR(3) DEFAULT NULL,
  average DOUBLE DEFAULT NULL,
  PRIMARY KEY (id_bimester),
  INDEX FK_tbl_bimester_tbl_subject_id_subject (id_subject),
  INDEX FK_tbl_record_tbl_alumn_id_alumn (id_alumno),
  CONSTRAINT FK_tbl_bimester_tbl_alumn_id_alumn FOREIGN KEY (id_alumno)
    REFERENCES tbl_alumn(id_alumn),
  CONSTRAINT FK_tbl_bimester_tbl_subject_id_subject FOREIGN KEY (id_subject)
    REFERENCES tbl_subject(id_subject)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_docente_curso
--
CREATE TABLE IF NOT EXISTS tbl_docente_curso (
  id_docente_curso VARCHAR(255),
  id_docente INT(11) DEFAULT NULL,
  id_curso VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_docente_curso),
  INDEX FK_tbl_docente_curso_tbl_course_id_course (id_curso),
  INDEX FK_tbl_docente_curso_tbl_docente_id_docente (id_docente),
  CONSTRAINT FK_tbl_docente_curso_tbl_course_id_course FOREIGN KEY (id_curso)
    REFERENCES tbl_course(id_course),
  CONSTRAINT FK_tbl_docente_curso_tbl_docente_id_docente FOREIGN KEY (id_docente)
    REFERENCES tbl_docente(id_docente)
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_role_permission
--
CREATE TABLE IF NOT EXISTS tbl_role_permission (
  id_role_permission INT(11) NOT NULL AUTO_INCREMENT,
  id_role VARCHAR(255) DEFAULT NULL,
  id_permission INT(11) DEFAULT NULL,
  valor TINYINT(4) DEFAULT 1,
  PRIMARY KEY (id_role_permission),
  INDEX FK_tlb_role_permission_tbl_permission_id_permission (id_permission),
  INDEX FK_tlb_role_permission_tbl_role_id_role (id_role),
  CONSTRAINT FK_tlb_role_permission_tbl_permission_id_permission FOREIGN KEY (id_permission)
    REFERENCES tbl_permission(id_permission),
  CONSTRAINT FK_tlb_role_permission_tbl_role_id_role FOREIGN KEY (id_role)
    REFERENCES tbl_role(id_role)
)
ENGINE = INNODB
AUTO_INCREMENT = 12
AVG_ROW_LENGTH = 1820
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
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_person
--
CREATE TABLE IF NOT EXISTS tbl_person (
  id_person INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT NULL,
  lastname VARCHAR(255) DEFAULT NULL,
  address VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(255) DEFAULT NULL,
  cellphone VARCHAR(255) DEFAULT NULL,
  dni VARCHAR(255) DEFAULT NULL,
  sex VARCHAR(255) DEFAULT NULL,
  `e-mail` VARCHAR(255) DEFAULT NULL,
  born VARCHAR(11) DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id_person),
  UNIQUE INDEX id_user (id_user),
  CONSTRAINT FK_tbl_person_tbl_users_id_user FOREIGN KEY (id_user)
    REFERENCES tbl_users(id_user)
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 5461
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_year_bimester
--
CREATE TABLE IF NOT EXISTS tbl_year_bimester (
  id_year_bimester INT(11) NOT NULL AUTO_INCREMENT,
  id_year INT(11) DEFAULT NULL,
  id_bimester INT(11) DEFAULT NULL,
  PRIMARY KEY (id_year_bimester),
  INDEX FK_tbl_year_bimester_tbl_bimester_id_bimester (id_bimester),
  INDEX FK_tbl_year_bimester_tbl_year_id_year_achademic (id_year),
  CONSTRAINT FK_tbl_year_bimester_tbl_bimester_id_bimester FOREIGN KEY (id_bimester)
    REFERENCES tbl_bimester(id_bimester),
  CONSTRAINT FK_tbl_year_bimester_tbl_year_id_year_achademic FOREIGN KEY (id_year)
    REFERENCES tbl_year(id_year_achademic)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

-- 
-- Dumping data for table tbl_alumn
--
INSERT INTO tbl_alumn VALUES 
  (1, 1, '1', 'A', 'H'),
  (2, 2, '1', 'A', 'H'),
  (3, 3, '1', 'A', 'H');

-- 
-- Dumping data for table tbl_course
--
-- Table does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_docente
--
-- Table does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_permission
--
INSERT INTO tbl_permission VALUES 
  (3, 'addAlumn', 'Agregar Alumno', 'Registrar nuevo Alumno', 1),
  (4, 'addDocente', 'Agregar Docente', 'Registrar nuevo Docente', 1),
  (5, 'editAlumn', 'Editar Alumno', 'editAlumn', 1),
  (6, 'editDocente', 'Editar Docente', NULL, 1),
  (7, 'elimAlumn', 'Eliminar Alumno', NULL, 1),
  (8, 'elimDocente', 'Eliminar Docente', NULL, 1),
  (9, 'asignarAlumn', 'Asignar Alumn', NULL, 1),
  (10, 'asignarDocente', 'Asignar Docente', NULL, 1),
  (11, 'aperturarAno', 'Aperturar Año', 'Apertura de nuevo año acedmico', 1);

-- 
-- Dumping data for table tbl_role
--
INSERT INTO tbl_role VALUES 
  ('dir', 'Director');

-- 
-- Dumping data for table tbl_subject
--
-- Table does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_year
--
INSERT INTO tbl_year VALUES 
  (1, 2013, 'V');

-- 
-- Dumping data for table tbl_bimester
--
-- Table does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_docente_curso
--
-- Table does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_role_permission
--
INSERT INTO tbl_role_permission VALUES 
  (3, 'dir', 3, 1),
  (4, 'dir', 4, 1),
  (5, 'dir', 5, 1),
  (6, 'dir', 6, 1),
  (7, 'dir', 7, 1),
  (8, 'dir', 8, 1),
  (9, 'dir', 9, 1),
  (10, 'dir', 10, 1),
  (11, 'dir', 11, 1);

-- 
-- Dumping data for table tbl_users
--
INSERT INTO tbl_users VALUES 
  (1, 'delmonxd@gmail.com', 'holi', 'dir'),
  (3, 'cmandamiento', '1234', 'dir');

-- 
-- Dumping data for table tbl_person
--
INSERT INTO tbl_person VALUES 
  (1, 'Martín Antonio', 'Eguizabal Pichilingue', 'Coperativa Ingenio S/N', '-', '966479762', '71088598', 'M', 'martianep19@gmail.com', '20-11-1992', NULL),
  (2, 'Flavio Magyver', 'Figueroa Villarreal', 'AAHH Manzanares Et. 4 D-10', '-', '985037996', '71998024', 'M', 'magyverfigueroa@gmail.com', '09-03-1993', NULL),
  (3, 'César Oswaldo', 'Mandamiento Salas', 'Av. Centenario #1177', '012392255', '980312797', '72271819', 'M', 'delmonxd@gmail.com', '19-07-1993', NULL);

-- 
-- Dumping data for table tbl_year_bimester
--
-- Table does not contain any data (it is empty)

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;