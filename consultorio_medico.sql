
-- -----------------------------------------------------
-- Schema consultorio_medico
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS consultorio_medico ;
USE consultorio_medico ;

-- -----------------------------------------------------
-- Table barrios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS barrios (
  id_barrio BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre_barrio VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (id_barrio))



-- -----------------------------------------------------
-- Table calles
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS calles (
  id_calle BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre_calle VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (id_calle))



-- -----------------------------------------------------
-- Table documentaciones
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS documentaciones (
  id_documento BIGINT(20) NOT NULL AUTO_INCREMENT,
  tipo_documento VARCHAR(10) NULL DEFAULT NULL,
  numero_documento VARCHAR(10) NULL DEFAULT NULL,
  cuil VARCHAR(20) NULL DEFAULT NULL,
  nro_seg_social BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_documento))




-- -----------------------------------------------------
-- Table personas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS personas (
  id_persona BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NULL DEFAULT NULL,
  apellido VARCHAR(100) NULL DEFAULT NULL,
  sexo VARCHAR(30) NULL DEFAULT NULL,
  id_documento BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_persona),
  INDEX id_documento (id_documento ASC) VISIBLE,
  CONSTRAINT personas_ibfk_1
    FOREIGN KEY (id_documento)
    REFERENCES documentaciones (id_documento)
    ON DELETE CASCADE
    ON UPDATE CASCADE)




-- -----------------------------------------------------
-- Table medicos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS medicos (
  id_medico BIGINT(20) NOT NULL AUTO_INCREMENT,
  id_persona BIGINT(20) NULL DEFAULT NULL,
  matricula_medico VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (id_medico),
  INDEX id_persona (id_persona ASC) VISIBLE,
  CONSTRAINT medicos_ibfk_1
    FOREIGN KEY (id_persona)
    REFERENCES personas (id_persona)
    ON DELETE CASCADE
    ON UPDATE CASCADE)




-- -----------------------------------------------------
-- Table pacientes
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS pacientes (
  Id_paciente BIGINT(20) NOT NULL AUTO_INCREMENT,
  informacion_medica VARCHAR(100) NULL DEFAULT NULL,
  id_persona BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (Id_paciente),
  INDEX id_persona (id_persona ASC) VISIBLE,
  CONSTRAINT pacientes_ibfk_1
    FOREIGN KEY (id_persona)
    REFERENCES personas (id_persona)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table consultas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS consultas (
  id_consulta BIGINT(20) NOT NULL AUTO_INCREMENT,
  descripcion_consulta VARCHAR(200) NULL DEFAULT NULL,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  id_medico BIGINT(20) NULL DEFAULT NULL,
  id_paciente BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_consulta),
  INDEX id_medico (id_medico ASC) VISIBLE,
  INDEX id_paciente (id_paciente ASC) VISIBLE,
  CONSTRAINT consultas_ibfk_1
    FOREIGN KEY (id_medico)
    REFERENCES medicos (id_medico)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT consultas_ibfk_2
    FOREIGN KEY (id_paciente)
    REFERENCES pacientes (Id_paciente)
    ON DELETE CASCADE
    ON UPDATE CASCADE)




-- -----------------------------------------------------
-- Table paises
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS paises (
  id_pais BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre_pais VARCHAR(100) NULL DEFAULT NULL,
  PRIMARY KEY (id_pais))



-- -----------------------------------------------------
-- Table provincias
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS provincias (
  id_provincia BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre_provincia VARCHAR(100) NULL DEFAULT NULL,
  id_pais BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_provincia),
  INDEX id_pais (id_pais ASC) VISIBLE,
  CONSTRAINT provincias_ibfk_1
    FOREIGN KEY (id_pais)
    REFERENCES paises (id_pais)
    ON DELETE CASCADE
    ON UPDATE CASCADE)




-- -----------------------------------------------------
-- Table localidades
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS localidades (
  id_localidad BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre_localidad VARCHAR(150) NULL DEFAULT NULL,
  codigo_postal INT(5) NULL DEFAULT NULL,
  id_provincia BIGINT(20) NOT NULL,
  PRIMARY KEY (id_localidad),
  INDEX id_provincia (id_provincia ASC) VISIBLE,
  CONSTRAINT localidades_ibfk_1
    FOREIGN KEY (id_provincia)
    REFERENCES provincias (id_provincia)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table direcciones
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS direcciones (
  id_direccion BIGINT(20) NOT NULL AUTO_INCREMENT,
  residencia VARCHAR(150) NULL DEFAULT NULL,
  id_barrio BIGINT(20) NULL DEFAULT NULL,
  id_calle BIGINT(20) NULL DEFAULT NULL,
  altura_calle INT(4) NOT NULL,
  id_localidad BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_direccion),
  INDEX id_localidad (id_localidad ASC) VISIBLE,
  INDEX id_barrio (id_barrio ASC) VISIBLE,
  INDEX id_calle (id_calle ASC) VISIBLE,
  CONSTRAINT direcciones_ibfk_1
    FOREIGN KEY (id_localidad)
    REFERENCES localidades (id_localidad)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT direcciones_ibfk_3
    FOREIGN KEY (id_barrio)
    REFERENCES barrios (id_barrio)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT direcciones_ibfk_4
    FOREIGN KEY (id_calle)
    REFERENCES calles (id_calle)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table datos_contactos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS datos_contactos (
  id_contacto BIGINT(20) NOT NULL AUTO_INCREMENT,
  telefono BIGINT(12) NULL DEFAULT NULL,
  id_direccion BIGINT(20) NULL DEFAULT NULL,
  id_persona BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_contacto),
  INDEX id_direccion (id_direccion ASC) VISIBLE,
  INDEX id_persona (id_persona ASC) VISIBLE,
  CONSTRAINT datos_contactos_ibfk_1
    FOREIGN KEY (id_direccion)
    REFERENCES direcciones (id_direccion)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT datos_contactos_ibfk_2
    FOREIGN KEY (id_persona)
    REFERENCES personas (id_persona)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table puestos_trabajos
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS puestos_trabajos (
  id_puesto_trabajo BIGINT(20) NOT NULL AUTO_INCREMENT,
  nombre_puesto_trabajo VARCHAR(150) NULL DEFAULT NULL,
  PRIMARY KEY (id_puesto_trabajo))



-- -----------------------------------------------------
-- Table empleados
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS empleados (
  id_empleado BIGINT(20) NOT NULL AUTO_INCREMENT,
  id_persona BIGINT(20) NULL DEFAULT NULL,
  id_puesto_trabajo BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_empleado),
  INDEX id_persona (id_persona ASC) VISIBLE,
  INDEX id_puesto_trabajo (id_puesto_trabajo ASC) VISIBLE,
  CONSTRAINT empleados_ibfk_1
    FOREIGN KEY (id_persona)
    REFERENCES personas (id_persona)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT empleados_ibfk_2
    FOREIGN KEY (id_puesto_trabajo)
    REFERENCES puestos_trabajos (id_puesto_trabajo)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table revistas
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS revistas (
  id_revista BIGINT(20) NOT NULL AUTO_INCREMENT,
  tipo_revista VARCHAR(50) NULL DEFAULT NULL,
  PRIMARY KEY (id_revista))



-- -----------------------------------------------------
-- Table roles
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS roles (
  id_rol INT(4) NOT NULL AUTO_INCREMENT,
  descripcion VARCHAR(8) NULL DEFAULT NULL,
  PRIMARY KEY (id_rol))



-- -----------------------------------------------------
-- Table suplencias
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS suplencias (
  id_suplencia BIGINT(20) NOT NULL AUTO_INCREMENT,
  alta_suplencia VARCHAR(50) NULL DEFAULT NULL,
  baja_suplencia VARCHAR(50) NULL DEFAULT NULL,
  id_medico BIGINT(20) NULL DEFAULT NULL,
  id_revista BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (id_suplencia),
  INDEX id_medico (id_medico ASC) VISIBLE,
  INDEX id_revista (id_revista ASC) VISIBLE,
  CONSTRAINT suplencias_ibfk_1
    FOREIGN KEY (id_medico)
    REFERENCES medicos (id_medico)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT suplencias_ibfk_2
    FOREIGN KEY (id_revista)
    REFERENCES revistas (id_revista)
    ON DELETE CASCADE
    ON UPDATE CASCADE)



-- -----------------------------------------------------
-- Table usuarios
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usuarios (
  numero_usuario INT(4) NOT NULL AUTO_INCREMENT,
  email VARCHAR(100) NULL DEFAULT NULL,
  pass VARCHAR(10) NULL DEFAULT NULL,
  id_rol INT(4) NULL DEFAULT NULL,
  id_persona BIGINT(20) NULL DEFAULT NULL,
  PRIMARY KEY (numero_usuario),
  INDEX id_persona (id_persona ASC) VISIBLE,
  INDEX id_rol (id_rol ASC) VISIBLE,
  CONSTRAINT roles_ibfk_1
    FOREIGN KEY (id_rol)
    REFERENCES roles (id_rol)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT usuarios_ibfk_1
    FOREIGN KEY (id_persona)
    REFERENCES personas (id_persona)
    ON DELETE CASCADE
    ON UPDATE CASCADE)

