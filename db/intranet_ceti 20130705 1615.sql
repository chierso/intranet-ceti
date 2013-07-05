﻿-- Script was generated by Devart dbForge Studio for MySQL, Version 4.50.285.0
-- Script date 05/07/2013 16:15:18
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
	CHARACTER SET utf8
	COLLATE utf8_general_ci;

-- 
-- Set default database
--
USE intranet_ceti;

--
-- Definition for table tbl_bimester
--
CREATE TABLE IF NOT EXISTS tbl_bimester (
  id_bimester_bim INT(11) NOT NULL AUTO_INCREMENT,
  primer_bimestre DATE NOT NULL,
  segundo_bimestre DATE NOT NULL,
  tercer_bimestre DATE NOT NULL,
  cuarto_bimestre DATE NOT NULL,
  `year` INT(11) NOT NULL,
  PRIMARY KEY (id_bimester_bim)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
AUTO_INCREMENT = 16
AVG_ROW_LENGTH = 1260
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Definition for table tbl_role
--
CREATE TABLE IF NOT EXISTS tbl_role (
  id_role VARCHAR(255),
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_role)
)
ENGINE = INNODB
AVG_ROW_LENGTH = 5461
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Definition for table tbl_subject
--
CREATE TABLE IF NOT EXISTS tbl_subject (
  id_subject INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (id_subject)
)
ENGINE = INNODB
AUTO_INCREMENT = 15
AVG_ROW_LENGTH = 1489
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
AUTO_INCREMENT = 16
AVG_ROW_LENGTH = 2730
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
AUTO_INCREMENT = 45
AVG_ROW_LENGTH = 455
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
AUTO_INCREMENT = 44
AVG_ROW_LENGTH = 481
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
AUTO_INCREMENT = 41
AVG_ROW_LENGTH = 630
CHARACTER SET utf8
COLLATE utf8_general_ci;

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
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Definition for table tbl_registration
--
CREATE TABLE IF NOT EXISTS tbl_registration (
  id_registration INT(11) NOT NULL AUTO_INCREMENT,
  id_alumn INT(11) DEFAULT NULL,
  id_docente INT(4) NOT NULL DEFAULT 1,
  grade CHAR(1) DEFAULT NULL,
  section CHAR(1) DEFAULT NULL,
  `year` INT(4) DEFAULT NULL,
  PRIMARY KEY (id_registration),
  INDEX FK_tbl_registration_tbl_alumn_id_alumn (id_alumn),
  INDEX FK_tbl_registration_tbl_docente_id_docente (id_docente),
  CONSTRAINT FK_tbl_registration_tbl_alumn_id_alumn FOREIGN KEY (id_alumn)
    REFERENCES tbl_alumn(id_alumn),
  CONSTRAINT FK_tbl_saloon_tbl_docente_id_docente FOREIGN KEY (id_docente)
    REFERENCES tbl_docente(id_docente)
)
ENGINE = INNODB
AUTO_INCREMENT = 31
AVG_ROW_LENGTH = 630
CHARACTER SET utf8
COLLATE utf8_general_ci;

--
-- Definition for table tbl_record
--
CREATE TABLE IF NOT EXISTS tbl_record (
  id_record INT(11) NOT NULL AUTO_INCREMENT,
  id_subject INT(3) DEFAULT NULL,
  N1_average DOUBLE DEFAULT NULL,
  N2_average DOUBLE DEFAULT NULL,
  N3_average DOUBLE DEFAULT NULL,
  N4_average DOUBLE DEFAULT NULL,
  id_registration INT(11) DEFAULT NULL,
  PRIMARY KEY (id_record),
  INDEX FK_tbl_bimester_tbl_subject_id_subject (id_subject),
  INDEX FK_tbl_record_tbl_registration_id_registration (id_registration),
  CONSTRAINT FK_tbl_record_tbl_registration_id_registration FOREIGN KEY (id_registration)
    REFERENCES tbl_registration(id_registration),
  CONSTRAINT FK_tbl_record_tbl_subject_id_subject FOREIGN KEY (id_subject)
    REFERENCES tbl_subject(id_subject)
)
ENGINE = INNODB
AUTO_INCREMENT = 287
AVG_ROW_LENGTH = 57
CHARACTER SET utf8
COLLATE utf8_general_ci;

-- 
-- Dumping data for table tbl_bimester
--
INSERT INTO tbl_bimester VALUES 
  (1, '2013-05-24', '2013-07-19', '2013-10-16', '2013-12-20', 2013);

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
  (13, 'abm_alumno', 'Gestionar Alumno', 'Gestión ABM de alumnos'),
  (14, 'import_excel', 'Importar Notas', 'Importar notas desde Excel.'),
  (15, 'ver_notas', 'Ver Notas', 'Ver notas actuales');

-- 
-- Dumping data for table tbl_role
--
INSERT INTO tbl_role VALUES 
  ('alum', 'Alumno'),
  ('dir', 'Director'),
  ('doc', 'Docente');

-- 
-- Dumping data for table tbl_subject
--
INSERT INTO tbl_subject VALUES 
  (1, 'Persona Familia y Relaciones Humanas'),
  (2, 'Historia, Geografía y Economía'),
  (3, 'Matemática'),
  (4, 'Ciencia, Tecnología y Ambiente'),
  (5, 'Ed. Fisica'),
  (6, 'Ed. Religiosa'),
  (7, 'Formación Ciudadana y Cívica'),
  (8, 'Comunicación'),
  (12, 'Inglés'),
  (13, 'Arte'),
  (14, 'Educación para el Trabajo');

-- 
-- Dumping data for table tbl_role_permission
--
INSERT INTO tbl_role_permission VALUES 
  (3, 'dir', 3),
  (4, 'dir', 4),
  (12, 'dir', 12),
  (13, 'dir', 13),
  (14, 'dir', 14),
  (15, 'alum', 15);

-- 
-- Dumping data for table tbl_users
--
INSERT INTO tbl_users VALUES 
  (1, 'delmonxd@gmail.com', '8c416c2812ed806acb66520086da8972', 'dir'),
  (3, 'cmandamiento', '1234', 'dir'),
  (5, 'javi@bicho.com', 'h0fbppsb', 'doc'),
  (8, 'ma@me.com', 'hzc337pt', 'alum'),
  (13, 'martinaep19@gmail.com', 'kcrjzd3q', 'alum'),
  (14, 'magyver.figueroa@gmail.com', 'cpt4vfp1', 'alum'),
  (15, 'patricio@hotmail.com', '29m909bs', 'alum'),
  (16, 'rosa@gmail.com', '1tkvmyhz', 'alum'),
  (17, 'miranda@gmail.com', 'ydq5h4k3', 'alum'),
  (18, 'luis@gmail.com', 'x08vrn25', 'alum'),
  (19, 'dunia@hotmail.com', 'e0f36bbc14d5c5a4faf760d0234cad68', 'alum'),
  (20, '', 'hd5xwvry', 'alum'),
  (21, '', 'ffhwnvw7', 'alum'),
  (22, '', 'v6yjygw5', 'alum'),
  (23, '', '6sq16dm0', 'alum'),
  (24, '', 'yry5zh9w', 'alum'),
  (25, '', '2yyk00t1', 'alum'),
  (26, '', 'cx6tj480', 'alum'),
  (27, '', '3jt1vjy1', 'alum'),
  (28, '', 'c94krxsn', 'alum'),
  (29, '', '1q50z22f', 'alum'),
  (30, '', '4qcj5y80', 'alum'),
  (31, '', 'nm4m1jmg', 'alum'),
  (32, '', 'jjdqnmtq', 'alum'),
  (33, '', '25n1qggt', 'alum'),
  (34, '', 'trrpb2nj', 'alum'),
  (35, '', 'ycc7rqmj', 'alum'),
  (36, '', 'jdtq637m', 'alum'),
  (37, '', 'pdhfzpnr', 'alum'),
  (38, '', '05mzjgm0', 'alum'),
  (39, '', '0z9d2qv1', 'alum'),
  (40, '', 'ts3f0n6w', 'alum'),
  (41, '', 'gxv73vdg', 'alum'),
  (42, '', 'hzgr3xvg', 'alum'),
  (43, '', 'x6rv0rhv', 'alum'),
  (44, '', 'hc9c2c0p', 'alum');

-- 
-- Dumping data for table tbl_person
--
INSERT INTO tbl_person VALUES 
  (1, 'Martín Antonio', 'Eguizabal Pichilingue', 'Coperativa Ingenio S/N', '-', '966479762', '71088598', 'M', 'martianep19@gmail.com', '20-11-1992', NULL),
  (2, 'Flavio Magyver', 'Figueroa Villarreal', 'AAHH Manzanares Et. 4 D-10', '-', '985037996', '71998024', 'M', 'magyverfigueroa@gmail.com', '09-03-1993', NULL),
  (3, 'César Oswaldo', 'Mandamiento Salas', 'Av. Centenario #1177', '012392255', '980312797', '72271819', 'M', 'delmonxd@gmail.com', '19-07-1993', 1),
  (5, 'Carlos Antonio', 'Figueroa Pichilingue', 'Av. Los sauces #4477', '-', '987123456', '14723519', 'M', 'carlos@gmail.com', '10/06/1980', NULL),
  (6, 'Javier', 'Torres', 'Av. La paz 147', '-', '9741123854', '14785214', 'M', 'javi@bicho.com', '07-02-1984', NULL),
  (7, 'Pedro Martin', 'Figueroa Carreño', 'Psje. Loza #14', '-', '987025896', '78451285', 'M', 'ma@me.com', '12-07-1990', NULL),
  (12, 'Martin', 'Eguizabal Pichilingue', 'Coperativa Ingenio S/N', '-', '966479762', '71088598', 'M', 'martinaep19@gmail.com', '20-11-1992', NULL),
  (13, 'Magyver', 'Figueroa Villarreal', 'AAHH Manzanares - Mz. D Lt. 10', '-', '985037996', '71998024', 'M', 'magyver.figueroa@gmail.com', '09-03-1993', NULL),
  (18, 'Dunia Gabriela', 'ALCANTARA MORALES', '', '', '', '14', '', 'dunia@hotmail.com', '', 19),
  (19, 'Juan Manuel', 'CANALES PATRICIO', '', '', '', '14', '', '', '', NULL),
  (20, 'Patricia Isabel', 'CANCHARI CURE', '', '', '', '14', '', '', '', NULL),
  (21, 'Giancarlos', 'CASTILLON MERCEDES', '', '', '', '14', '', '', '', NULL),
  (22, 'Luis Fernando', 'COSTILLA RETUERTO', '', '', '', '14', '', '', '', NULL),
  (23, 'Miranda Massiel', 'CRUZ LEÓN', '', '', '', '14', '', '', '', NULL),
  (24, 'Luis Ángel', 'DÁVILA CARREÑO', '', '', '', '14', '', '', '', NULL),
  (25, 'Josie Alexandra', 'DÍAZ SÁNCHEZ', '', '', '', '14', '', '', '', NULL),
  (26, 'Melany Jubitsa', 'GARCÍA GRADOS', '', '', '', '14', '', '', '', NULL),
  (27, 'Inghie Lucia Christel', 'GARCIA PERALTA', '', '', '', '14', '', '', '', NULL),
  (28, 'Naysha Betsabeth', 'GOMERO TARAZONA', '', '', '', '14', '', '', '', NULL),
  (29, 'Juan Pablo', 'GUTIERREZ HURTADO', '', '', '', '14', '', '', '', NULL),
  (30, 'Fiorela Lisbeth', 'HERMENEGILDO ROMERO', '', '', '', '14', '', '', '', NULL),
  (31, 'Wendy Lisbeth', 'HUADO PICHILINGUE', '', '', '', '14', '', '', '', NULL),
  (32, 'Lucero Daniza', 'HUAMANI RONQUILLO', '', '', '', '14', '', '', '', NULL),
  (33, 'Cristhel Milagros', 'JUAREZ CHIRITO', '', '', '', '14', '', '', '', NULL),
  (34, 'Brayan Alfredo', 'LEAÑO HERRERA', '', '', '', '14', '', '', '', NULL),
  (35, 'Sandro Alexis', 'LINO ALCANTARA', '', '', '', '14', '', '', '', NULL),
  (36, 'Anderson Aldair', 'MEDINA BLAS', '', '', '', '14', '', '', '', NULL),
  (37, 'Luis Fernando', 'MEDINA FERNANDEZ', '', '', '', '14', '', '', '', NULL),
  (38, 'Clara Beatriz', 'MENDOZA BALLARDO', '', '', '', '14', '', '', '', NULL),
  (39, 'Nirvana Rosa', 'MENDOZA CÓRDOVA', '', '', '', '14', '', '', '', NULL),
  (40, 'Amarilis Sanet', 'PEREZ ALOR', '', '', '', '14', '', '', '', NULL),
  (41, 'Valeri Angelica', 'PEREZ MUÑOZ', '', '', '', '14', '', '', '', NULL),
  (42, 'Jamil Scott', 'VASQUEZ BARRIENTOS', '', '', '', '14', '', '', '', NULL),
  (43, 'Marina', 'YARLEQUÉ GOZZING', '', '', '', '14', '', '', '', NULL);

-- 
-- Dumping data for table tbl_alumn
--
INSERT INTO tbl_alumn VALUES 
  (15, 18, 'H'),
  (16, 19, 'H'),
  (17, 20, 'H'),
  (18, 21, 'H'),
  (19, 22, 'H'),
  (20, 23, 'H'),
  (21, 24, 'H'),
  (22, 25, 'H'),
  (23, 26, 'H'),
  (24, 27, 'H'),
  (25, 28, 'H'),
  (26, 29, 'H'),
  (27, 30, 'H'),
  (28, 31, 'H'),
  (29, 32, 'H'),
  (30, 33, 'H'),
  (31, 34, 'H'),
  (32, 35, 'H'),
  (33, 36, 'H'),
  (34, 37, 'H'),
  (35, 38, 'H'),
  (36, 39, 'H'),
  (37, 40, 'H'),
  (38, 41, 'H'),
  (39, 42, 'H'),
  (40, 43, 'H');

-- 
-- Dumping data for table tbl_docente
--
INSERT INTO tbl_docente VALUES 
  (1, 5),
  (2, 6);

-- 
-- Dumping data for table tbl_registration
--
INSERT INTO tbl_registration VALUES 
  (5, 15, 1, '3', 'A', 2013),
  (6, 16, 1, '3', 'A', 2013),
  (7, 17, 1, '3', 'A', 2013),
  (8, 18, 1, '3', 'A', 2013),
  (9, 19, 1, '3', 'A', 2013),
  (10, 20, 1, '3', 'A', 2013),
  (11, 21, 1, '3', 'A', 2013),
  (12, 22, 1, '3', 'A', 2013),
  (13, 23, 1, '3', 'A', 2013),
  (14, 24, 1, '3', 'A', 2013),
  (15, 25, 1, '3', 'A', 2013),
  (16, 26, 1, '3', 'A', 2013),
  (17, 27, 1, '3', 'A', 2013),
  (18, 28, 1, '3', 'A', 2013),
  (19, 29, 1, '3', 'A', 2013),
  (20, 30, 1, '3', 'A', 2013),
  (21, 31, 1, '3', 'A', 2013),
  (22, 32, 1, '3', 'A', 2013),
  (23, 33, 1, '3', 'A', 2013),
  (24, 34, 1, '3', 'A', 2013),
  (25, 35, 1, '3', 'A', 2013),
  (26, 36, 1, '3', 'A', 2013),
  (27, 37, 1, '3', 'A', 2013),
  (28, 38, 1, '3', 'A', 2013),
  (29, 39, 1, '3', 'A', 2013),
  (30, 40, 1, '3', 'A', 2013);

-- 
-- Dumping data for table tbl_record
--
INSERT INTO tbl_record VALUES 
  (1, 3, 11, NULL, NULL, NULL, 5),
  (2, 8, 14, NULL, NULL, NULL, 5),
  (3, 12, 15, NULL, NULL, NULL, 5),
  (4, 13, 12, NULL, NULL, NULL, 5),
  (5, 2, 15, NULL, NULL, NULL, 5),
  (6, 7, 14, NULL, NULL, NULL, 5),
  (7, 1, 15, NULL, NULL, NULL, 5),
  (8, 5, 16, NULL, NULL, NULL, 5),
  (9, 6, 16, NULL, NULL, NULL, 5),
  (10, 4, 14, NULL, NULL, NULL, 5),
  (11, 14, 13, NULL, NULL, NULL, 5),
  (12, 3, 18, NULL, NULL, NULL, 6),
  (13, 8, 16, NULL, NULL, NULL, 6),
  (14, 12, 16, NULL, NULL, NULL, 6),
  (15, 13, 15, NULL, NULL, NULL, 6),
  (16, 2, 16, NULL, NULL, NULL, 6),
  (17, 7, 13, NULL, NULL, NULL, 6),
  (18, 1, 17, NULL, NULL, NULL, 6),
  (19, 5, 18, NULL, NULL, NULL, 6),
  (20, 6, 15, NULL, NULL, NULL, 6),
  (21, 4, 15, NULL, NULL, NULL, 6),
  (22, 14, 19, NULL, NULL, NULL, 6),
  (23, 3, 15, NULL, NULL, NULL, 7),
  (24, 8, 14, NULL, NULL, NULL, 7),
  (25, 12, 14, NULL, NULL, NULL, 7),
  (26, 13, 13, NULL, NULL, NULL, 7),
  (27, 2, 15, NULL, NULL, NULL, 7),
  (28, 7, 14, NULL, NULL, NULL, 7),
  (29, 1, 16, NULL, NULL, NULL, 7),
  (30, 5, 17, NULL, NULL, NULL, 7),
  (31, 6, 16, NULL, NULL, NULL, 7),
  (32, 4, 14, NULL, NULL, NULL, 7),
  (33, 14, 13, NULL, NULL, NULL, 7),
  (34, 3, 12, NULL, NULL, NULL, 8),
  (35, 8, 13, NULL, NULL, NULL, 8),
  (36, 12, 12, NULL, NULL, NULL, 8),
  (37, 13, 12, NULL, NULL, NULL, 8),
  (38, 2, 12, NULL, NULL, NULL, 8),
  (39, 7, 12, NULL, NULL, NULL, 8),
  (40, 1, 9, NULL, NULL, NULL, 8),
  (41, 5, 13, NULL, NULL, NULL, 8),
  (42, 6, 13, NULL, NULL, NULL, 8),
  (43, 4, 13, NULL, NULL, NULL, 8),
  (44, 14, 13, NULL, NULL, NULL, 8),
  (45, 3, 8, NULL, NULL, NULL, 9),
  (46, 8, 10, NULL, NULL, NULL, 9),
  (47, 12, 12, NULL, NULL, NULL, 9),
  (48, 13, 10, NULL, NULL, NULL, 9),
  (49, 2, 12, NULL, NULL, NULL, 9),
  (50, 7, 12, NULL, NULL, NULL, 9),
  (51, 1, 9, NULL, NULL, NULL, 9),
  (52, 5, 17, NULL, NULL, NULL, 9),
  (53, 6, 14, NULL, NULL, NULL, 9),
  (54, 4, 11, NULL, NULL, NULL, 9),
  (55, 14, 13, NULL, NULL, NULL, 9),
  (56, 3, 12, NULL, NULL, NULL, 10),
  (57, 8, 14, NULL, NULL, NULL, 10),
  (58, 12, 14, NULL, NULL, NULL, 10),
  (59, 13, 12, NULL, NULL, NULL, 10),
  (60, 2, 14, NULL, NULL, NULL, 10),
  (61, 7, 14, NULL, NULL, NULL, 10),
  (62, 1, 14, NULL, NULL, NULL, 10),
  (63, 5, 18, NULL, NULL, NULL, 10),
  (64, 6, 15, NULL, NULL, NULL, 10),
  (65, 4, 14, NULL, NULL, NULL, 10),
  (66, 14, 13, NULL, NULL, NULL, 10),
  (67, 3, 14, NULL, NULL, NULL, 11),
  (68, 8, 15, NULL, NULL, NULL, 11),
  (69, 12, 14, NULL, NULL, NULL, 11),
  (70, 13, 12, NULL, NULL, NULL, 11),
  (71, 2, 16, NULL, NULL, NULL, 11),
  (72, 7, 13, NULL, NULL, NULL, 11),
  (73, 1, 14, NULL, NULL, NULL, 11),
  (74, 5, 17, NULL, NULL, NULL, 11),
  (75, 6, 14, NULL, NULL, NULL, 11),
  (76, 4, 14, NULL, NULL, NULL, 11),
  (77, 14, 12, NULL, NULL, NULL, 11),
  (78, 3, 12, NULL, NULL, NULL, 12),
  (79, 8, 14, NULL, NULL, NULL, 12),
  (80, 12, 14, NULL, NULL, NULL, 12),
  (81, 13, 15, NULL, NULL, NULL, 12),
  (82, 2, 13, NULL, NULL, NULL, 12),
  (83, 7, 13, NULL, NULL, NULL, 12),
  (84, 1, 14, NULL, NULL, NULL, 12),
  (85, 5, 17, NULL, NULL, NULL, 12),
  (86, 6, 15, NULL, NULL, NULL, 12),
  (87, 4, 14, NULL, NULL, NULL, 12),
  (88, 14, 10, NULL, NULL, NULL, 12),
  (89, 3, 12, NULL, NULL, NULL, 13),
  (90, 8, 13, NULL, NULL, NULL, 13),
  (91, 12, 12, NULL, NULL, NULL, 13),
  (92, 13, 13, NULL, NULL, NULL, 13),
  (93, 2, 17, NULL, NULL, NULL, 13),
  (94, 7, 13, NULL, NULL, NULL, 13),
  (95, 1, 13, NULL, NULL, NULL, 13),
  (96, 5, 16, NULL, NULL, NULL, 13),
  (97, 6, 14, NULL, NULL, NULL, 13),
  (98, 4, 13, NULL, NULL, NULL, 13),
  (99, 14, 12, NULL, NULL, NULL, 13),
  (100, 3, 16, NULL, NULL, NULL, 14),
  (101, 8, 15, NULL, NULL, NULL, 14),
  (102, 12, 14, NULL, NULL, NULL, 14),
  (103, 13, 16, NULL, NULL, NULL, 14),
  (104, 2, 18, NULL, NULL, NULL, 14),
  (105, 7, 13, NULL, NULL, NULL, 14),
  (106, 1, 15, NULL, NULL, NULL, 14),
  (107, 5, 16, NULL, NULL, NULL, 14),
  (108, 6, 15, NULL, NULL, NULL, 14),
  (109, 4, 15, NULL, NULL, NULL, 14),
  (110, 14, 13, NULL, NULL, NULL, 14),
  (111, 3, 11, NULL, NULL, NULL, 15),
  (112, 8, 12, NULL, NULL, NULL, 15),
  (113, 12, 12, NULL, NULL, NULL, 15),
  (114, 13, 12, NULL, NULL, NULL, 15),
  (115, 2, 14, NULL, NULL, NULL, 15),
  (116, 7, 13, NULL, NULL, NULL, 15),
  (117, 1, 13, NULL, NULL, NULL, 15),
  (118, 5, 17, NULL, NULL, NULL, 15),
  (119, 6, 15, NULL, NULL, NULL, 15),
  (120, 4, 13, NULL, NULL, NULL, 15),
  (121, 14, 13, NULL, NULL, NULL, 15),
  (122, 3, 18, NULL, NULL, NULL, 16),
  (123, 8, 18, NULL, NULL, NULL, 16),
  (124, 12, 17, NULL, NULL, NULL, 16),
  (125, 13, 17, NULL, NULL, NULL, 16),
  (126, 2, 19, NULL, NULL, NULL, 16),
  (127, 7, 13, NULL, NULL, NULL, 16),
  (128, 1, 17, NULL, NULL, NULL, 16),
  (129, 5, 17, NULL, NULL, NULL, 16),
  (130, 6, 16, NULL, NULL, NULL, 16),
  (131, 4, 17, NULL, NULL, NULL, 16),
  (132, 14, 17, NULL, NULL, NULL, 16),
  (133, 3, 11, NULL, NULL, NULL, 17),
  (134, 8, 12, NULL, NULL, NULL, 17),
  (135, 12, 12, NULL, NULL, NULL, 17),
  (136, 13, 13, NULL, NULL, NULL, 17),
  (137, 2, 14, NULL, NULL, NULL, 17),
  (138, 7, 13, NULL, NULL, NULL, 17),
  (139, 1, 16, NULL, NULL, NULL, 17),
  (140, 5, 16, NULL, NULL, NULL, 17),
  (141, 6, 15, NULL, NULL, NULL, 17),
  (142, 4, 14, NULL, NULL, NULL, 17),
  (143, 14, 12, NULL, NULL, NULL, 17),
  (144, 3, 19, NULL, NULL, NULL, 18),
  (145, 8, 18, NULL, NULL, NULL, 18),
  (146, 12, 16, NULL, NULL, NULL, 18),
  (147, 13, 18, NULL, NULL, NULL, 18),
  (148, 2, 17, NULL, NULL, NULL, 18),
  (149, 7, 16, NULL, NULL, NULL, 18),
  (150, 1, 17, NULL, NULL, NULL, 18),
  (151, 5, 17, NULL, NULL, NULL, 18),
  (152, 6, 18, NULL, NULL, NULL, 18),
  (153, 4, 17, NULL, NULL, NULL, 18),
  (154, 14, 17, NULL, NULL, NULL, 18),
  (155, 3, 10, NULL, NULL, NULL, 19),
  (156, 8, 10, NULL, NULL, NULL, 19),
  (157, 12, 12, NULL, NULL, NULL, 19),
  (158, 13, 12, NULL, NULL, NULL, 19),
  (159, 2, 11, NULL, NULL, NULL, 19),
  (160, 7, 14, NULL, NULL, NULL, 19),
  (161, 1, 10, NULL, NULL, NULL, 19),
  (162, 5, 17, NULL, NULL, NULL, 19),
  (163, 6, 15, NULL, NULL, NULL, 19),
  (164, 4, 12, NULL, NULL, NULL, 19),
  (165, 14, 11, NULL, NULL, NULL, 19),
  (166, 3, 15, NULL, NULL, NULL, 20),
  (167, 8, 17, NULL, NULL, NULL, 20),
  (168, 12, 14, NULL, NULL, NULL, 20),
  (169, 13, 15, NULL, NULL, NULL, 20),
  (170, 2, 17, NULL, NULL, NULL, 20),
  (171, 7, 16, NULL, NULL, NULL, 20),
  (172, 1, 17, NULL, NULL, NULL, 20),
  (173, 5, 17, NULL, NULL, NULL, 20),
  (174, 6, 17, NULL, NULL, NULL, 20),
  (175, 4, 16, NULL, NULL, NULL, 20),
  (176, 14, 16, NULL, NULL, NULL, 20),
  (177, 3, 9, NULL, NULL, NULL, 21),
  (178, 8, 11, NULL, NULL, NULL, 21),
  (179, 12, 13, NULL, NULL, NULL, 21),
  (180, 13, 13, NULL, NULL, NULL, 21),
  (181, 2, 11, NULL, NULL, NULL, 21),
  (182, 7, 12, NULL, NULL, NULL, 21),
  (183, 1, 11, NULL, NULL, NULL, 21),
  (184, 5, 17, NULL, NULL, NULL, 21),
  (185, 6, 13, NULL, NULL, NULL, 21),
  (186, 4, 12, NULL, NULL, NULL, 21),
  (187, 14, 11, NULL, NULL, NULL, 21),
  (188, 3, 15, NULL, NULL, NULL, 22),
  (189, 8, 13, NULL, NULL, NULL, 22),
  (190, 12, 13, NULL, NULL, NULL, 22),
  (191, 13, 14, NULL, NULL, NULL, 22),
  (192, 2, 12, NULL, NULL, NULL, 22),
  (193, 7, 13, NULL, NULL, NULL, 22),
  (194, 1, 13, NULL, NULL, NULL, 22),
  (195, 5, 18, NULL, NULL, NULL, 22),
  (196, 6, 15, NULL, NULL, NULL, 22),
  (197, 4, 13, NULL, NULL, NULL, 22),
  (198, 14, 13, NULL, NULL, NULL, 22),
  (199, 3, 9, NULL, NULL, NULL, 23),
  (200, 8, 9, NULL, NULL, NULL, 23),
  (201, 12, 12, NULL, NULL, NULL, 23),
  (202, 13, 11, NULL, NULL, NULL, 23),
  (203, 2, 11, NULL, NULL, NULL, 23),
  (204, 7, 13, NULL, NULL, NULL, 23),
  (205, 1, 10, NULL, NULL, NULL, 23),
  (206, 5, 16, NULL, NULL, NULL, 23),
  (207, 6, 10, NULL, NULL, NULL, 23),
  (208, 4, 10, NULL, NULL, NULL, 23),
  (209, 14, 13, NULL, NULL, NULL, 23),
  (210, 3, 12, NULL, NULL, NULL, 24),
  (211, 8, 13, NULL, NULL, NULL, 24),
  (212, 12, 14, NULL, NULL, NULL, 24),
  (213, 13, 14, NULL, NULL, NULL, 24),
  (214, 2, 11, NULL, NULL, NULL, 24),
  (215, 7, 12, NULL, NULL, NULL, 24),
  (216, 1, 12, NULL, NULL, NULL, 24),
  (217, 5, 16, NULL, NULL, NULL, 24),
  (218, 6, 15, NULL, NULL, NULL, 24),
  (219, 4, 13, NULL, NULL, NULL, 24),
  (220, 14, 14, NULL, NULL, NULL, 24),
  (221, 3, 15, NULL, NULL, NULL, 25),
  (222, 8, 17, NULL, NULL, NULL, 25),
  (223, 12, 15, NULL, NULL, NULL, 25),
  (224, 13, 16, NULL, NULL, NULL, 25),
  (225, 2, 17, NULL, NULL, NULL, 25),
  (226, 7, 13, NULL, NULL, NULL, 25),
  (227, 1, 18, NULL, NULL, NULL, 25),
  (228, 5, 17, NULL, NULL, NULL, 25),
  (229, 6, 17, NULL, NULL, NULL, 25),
  (230, 4, 15, NULL, NULL, NULL, 25),
  (231, 14, 14, NULL, NULL, NULL, 25),
  (232, 3, 14, NULL, NULL, NULL, 26),
  (233, 8, 13, NULL, NULL, NULL, 26),
  (234, 12, 13, NULL, NULL, NULL, 26),
  (235, 13, 11, NULL, NULL, NULL, 26),
  (236, 2, 13, NULL, NULL, NULL, 26),
  (237, 7, 15, NULL, NULL, NULL, 26),
  (238, 1, 13, NULL, NULL, NULL, 26),
  (239, 5, 16, NULL, NULL, NULL, 26),
  (240, 6, 14, NULL, NULL, NULL, 26),
  (241, 4, 13, NULL, NULL, NULL, 26),
  (242, 14, 15, NULL, NULL, NULL, 26),
  (243, 3, 12, NULL, NULL, NULL, 27),
  (244, 8, 12, NULL, NULL, NULL, 27),
  (245, 12, 13, NULL, NULL, NULL, 27),
  (246, 13, 15, NULL, NULL, NULL, 27),
  (247, 2, 14, NULL, NULL, NULL, 27),
  (248, 7, 13, NULL, NULL, NULL, 27),
  (249, 1, 10, NULL, NULL, NULL, 27),
  (250, 5, 17, NULL, NULL, NULL, 27),
  (251, 6, 13, NULL, NULL, NULL, 27),
  (252, 4, 13, NULL, NULL, NULL, 27),
  (253, 14, 11, NULL, NULL, NULL, 27),
  (254, 3, 15, NULL, NULL, NULL, 28),
  (255, 8, 16, NULL, NULL, NULL, 28),
  (256, 12, 15, NULL, NULL, NULL, 28),
  (257, 13, 16, NULL, NULL, NULL, 28),
  (258, 2, 17, NULL, NULL, NULL, 28),
  (259, 7, 14, NULL, NULL, NULL, 28),
  (260, 1, 18, NULL, NULL, NULL, 28),
  (261, 5, 17, NULL, NULL, NULL, 28),
  (262, 6, 14, NULL, NULL, NULL, 28),
  (263, 4, 16, NULL, NULL, NULL, 28),
  (264, 14, 13, NULL, NULL, NULL, 28),
  (265, 3, 14, NULL, NULL, NULL, 29),
  (266, 8, 13, NULL, NULL, NULL, 29),
  (267, 12, 13, NULL, NULL, NULL, 29),
  (268, 13, 12, NULL, NULL, NULL, 29),
  (269, 2, 16, NULL, NULL, NULL, 29),
  (270, 7, 12, NULL, NULL, NULL, 29),
  (271, 1, 11, NULL, NULL, NULL, 29),
  (272, 5, 17, NULL, NULL, NULL, 29),
  (273, 6, 15, NULL, NULL, NULL, 29),
  (274, 4, 14, NULL, NULL, NULL, 29),
  (275, 14, 13, NULL, NULL, NULL, 29),
  (276, 3, 16, NULL, NULL, NULL, 30),
  (277, 8, 18, NULL, NULL, NULL, 30),
  (278, 12, 15, NULL, NULL, NULL, 30),
  (279, 13, 16, NULL, NULL, NULL, 30),
  (280, 2, 17, NULL, NULL, NULL, 30),
  (281, 7, 15, NULL, NULL, NULL, 30),
  (282, 1, 18, NULL, NULL, NULL, 30),
  (283, 5, 17, NULL, NULL, NULL, 30),
  (284, 6, 17, NULL, NULL, NULL, 30),
  (285, 4, 16, NULL, NULL, NULL, 30),
  (286, 14, 13, NULL, NULL, NULL, 30);

-- 
-- Enable foreign keys
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;