﻿-- Script was generated by Devart dbForge Studio for MySQL, Version 5.0.67.0
-- Product home page: http://www.devart.com/dbforge/mysql/studio
-- Script date 29/04/2013 01:46:43 a.m.
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
CREATE DATABASE intranet_ceti
	CHARACTER SET latin1
	COLLATE latin1_swedish_ci;

-- 
-- Set default database
--
USE intranet_ceti;

--
-- Definition for table tbl_alumn
--
CREATE TABLE tbl_alumn (
  id_alumn INT(11) NOT NULL AUTO_INCREMENT,
  id_person INT(11) DEFAULT NULL,
  grade VARCHAR(1) DEFAULT NULL,
  section VARCHAR(255) DEFAULT NULL,
  `condition` VARCHAR(10) DEFAULT NULL,
  PRIMARY KEY (id_alumn),
  UNIQUE INDEX id_person (id_person)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_course
--
CREATE TABLE tbl_course (
  id_course VARCHAR(255) NOT NULL DEFAULT '',
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_course)
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_docente
--
CREATE TABLE tbl_docente (
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
CREATE TABLE tbl_permission (
  id_permission INT(11) NOT NULL AUTO_INCREMENT,
  key_permission VARCHAR(255) NOT NULL,
  name VARCHAR(255) DEFAULT NULL,
  description TEXT DEFAULT NULL,
  valor TINYINT(4) NOT NULL DEFAULT 1,
  PRIMARY KEY (id_permission),
  UNIQUE INDEX key_permission (key_permission)
)
ENGINE = INNODB
AUTO_INCREMENT = 11
AVG_ROW_LENGTH = 2048
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_record
--
CREATE TABLE tbl_record (
  id_record INT(11) NOT NULL AUTO_INCREMENT,
  id_alumno INT(11) DEFAULT NULL,
  id_grade INT(11) DEFAULT NULL,
  id_section INT(11) DEFAULT NULL,
  id_curso VARCHAR(255) DEFAULT NULL,
  nota_final INT(11) DEFAULT NULL,
  PRIMARY KEY (id_record),
  INDEX FK_tbl_record_tbl_alumn_id_alumn (id_alumno)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_role
--
CREATE TABLE tbl_role (
  id_role VARCHAR(255) NOT NULL DEFAULT '',
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_role)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 16384
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_docente_curso
--
CREATE TABLE tbl_docente_curso (
  id_docente_curso VARCHAR(255) NOT NULL DEFAULT '',
  id_docente INT(11) DEFAULT NULL,
  id_curso VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_docente_curso),
  INDEX FK_tbl_docente_curso_tbl_course_id_course (id_curso),
  INDEX FK_tbl_docente_curso_tbl_docente_id_docente (id_docente),
  CONSTRAINT FK_tbl_docente_curso_tbl_course_id_course FOREIGN KEY (id_curso)
    REFERENCES tbl_course(id_course) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_tbl_docente_curso_tbl_docente_id_docente FOREIGN KEY (id_docente)
    REFERENCES tbl_docente(id_docente) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_role_permission
--
CREATE TABLE tbl_role_permission (
  id_role_permission INT(11) NOT NULL AUTO_INCREMENT,
  id_role VARCHAR(255) DEFAULT NULL,
  id_permission INT(11) DEFAULT NULL,
  valor TINYINT(4) DEFAULT 1,
  PRIMARY KEY (id_role_permission),
  INDEX FK_tlb_role_permission_tbl_permission_id_permission (id_permission),
  INDEX FK_tlb_role_permission_tbl_role_id_role (id_role),
  CONSTRAINT FK_tlb_role_permission_tbl_permission_id_permission FOREIGN KEY (id_permission)
    REFERENCES tbl_permission(id_permission) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT FK_tlb_role_permission_tbl_role_id_role FOREIGN KEY (id_role)
    REFERENCES tbl_role(id_role) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 11
AVG_ROW_LENGTH = 2048
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_users
--
CREATE TABLE tbl_users (
  id_user INT(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  id_role VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_user),
  INDEX FK_tbl_user_tbl_role_id_role (id_role),
  CONSTRAINT FK_tbl_user_tbl_role_id_role FOREIGN KEY (id_role)
    REFERENCES tbl_role(id_role) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 4
AVG_ROW_LENGTH = 8192
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

--
-- Definition for table tbl_person
--
CREATE TABLE tbl_person (
  id_person INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT NULL,
  lastname VARCHAR(255) DEFAULT NULL,
  address VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(255) DEFAULT NULL,
  cellphone VARCHAR(255) DEFAULT NULL,
  dni VARCHAR(255) DEFAULT NULL,
  sex VARCHAR(255) DEFAULT NULL,
  `e-mail` VARCHAR(255) DEFAULT NULL,
  born DATE DEFAULT NULL,
  id_user INT(11) DEFAULT NULL,
  PRIMARY KEY (id_person),
  UNIQUE INDEX id_user (id_user),
  CONSTRAINT FK_tbl_person_tbl_users_id_user FOREIGN KEY (id_user)
    REFERENCES tbl_users(id_user) ON DELETE RESTRICT ON UPDATE RESTRICT
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 5461
CHARACTER SET latin1
COLLATE latin1_swedish_ci;

-- 
-- Dumping data for table tbl_alumn
--
INSERT INTO tbl_alumn VALUES 
  (1, 1, '4', 'A', 'H'),
  (2, 5, '3', 'a', 'H');

-- 
-- Dumping data for table tbl_course
--
-- Table intranet_ceti.tbl_course does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_docente
--
-- Table intranet_ceti.tbl_docente does not contain any data (it is empty)

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
  (10, 'asignarDocente', 'Asignar Docente', NULL, 1);

-- 
-- Dumping data for table tbl_record
--
-- Table intranet_ceti.tbl_record does not contain any data (it is empty)

-- 
-- Dumping data for table tbl_role
--
INSERT INTO tbl_role VALUES 
  ('dir', 'Director');

-- 
-- Dumping data for table tbl_docente_curso
--
-- Table intranet_ceti.tbl_docente_curso does not contain any data (it is empty)

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
  (10, 'dir', 10, 1);

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
  (1, 'Cesar', 'Mandamiento', 'Av centenario', '2392255', '980312797', '72271819', 'm', 'delmonxd@gmail.com', NULL, 1),
  (5, 'Martin', 'Eguizabal', 'Av ingenio', '4147', '996448225', '74125896', 'M', 'martinaep19@gmail.com', '0000-00-00', NULL);

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;